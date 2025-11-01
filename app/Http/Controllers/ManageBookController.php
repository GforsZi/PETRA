<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\BookMajor;
use App\Models\BookOrigin;
use App\Models\DeweyDecimalClassfication;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Spatie\PdfToImage\Pdf as PdfToImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ManageBookController extends Controller
{
    public function manage_book_page(Request $request)
    {
        $books = Book::select(
            'bk_id',
            'bk_title',
            'bk_img_url',
            'bk_type',
            'bk_published_year',
            'bk_publisher_id',
            'bk_major_id',
            'bk_origin_id'
        )
            ->with([
                'publisher:pub_id,pub_name',
                'authors:athr_id,athr_name',
                'deweyDecimalClassfications:ddc_id,ddc_code',
                'major:bk_mjr_id,bk_mjr_major',
                'origin:bk_orgn_id,bk_orgn_name',
            ])
            ->when($request->query('s'), function ($query, $search) {
                $query->where('bk_title', 'like', "%{$search}%");
            })
            ->when($request->query('author'), function ($query, $authorId) {
                $query->whereHas('authors', function ($q) use ($authorId) {
                    $q->where('athr_id', $authorId);
                });
            })
            ->when($request->query('ddc'), function ($query, $ddcId) {
                $query->whereHas('deweyDecimalClassfications', function ($q) use ($ddcId) {
                    $q->where('ddc_id', $ddcId);
                });
            })
            ->when($request->query('major'), function ($query, $majorId) {
                $query->where('bk_major_id', $majorId);
            })
            ->when($request->query('origin'), function ($query, $originId) {
                $query->where('bk_origin_id', $originId);
            })
            ->when($request->query('publisher'), function ($query, $publisherId) {
                $query->where('bk_publisher_id', $publisherId);
            })

            ->latest()
            ->paginate(12);


        return view('book.view', ['title' => 'Halaman kelola buku'], compact('books'));
    }

    public function search_book_system(Request $request)
    {
        $queryN = $request->get('q');
        $queryP = $request->get('purpose');
        $books = null;
        if ($queryP == '2') {
            $books = Book::select('bk_id', 'bk_title', 'bk_img_url', 'bk_major_id')
                ->where('bk_type', '1')
                ->with('bookCopies')
                ->where('bk_title', 'like', "%$queryN%")
                ->where('bk_major_id', null)
                ->where('bk_permission', '1')
                ->orderBy('bk_title', 'asc')
                ->get();
        } elseif ($queryP == '1') {
            $books = Book::select('bk_id', 'bk_title', 'bk_img_url', 'bk_major_id')
                ->where('bk_type', '1')
                ->with('bookCopies')
                ->where('bk_title', 'like', "%$queryN%")
                ->where('bk_major_id', '!=', null)
                ->where('bk_permission', '1')
                ->orderBy('bk_title', 'asc')
                ->get();
        }

        return response()->json($books);
    }

    public function search_book_author_system(Request $request)
    {
        $query = $request->get('q');
        $authors = Author::select('athr_id', 'athr_name')
            ->where('athr_name', 'like', "%$query%")
            ->orderBy('athr_name', 'asc')
            ->get();
        return response()->json($authors);
    }

    public function search_book_publisher_system(Request $request)
    {
        $query = $request->get('q');
        if ($query != '') {
            $publishers = Publisher::select('pub_id', 'pub_name')
                ->where('pub_name', 'like', "%$query%")
                ->orderBy('pub_name', 'asc')
                ->get();
        } else {
            $publishers = Publisher::select('pub_id', 'pub_name')->orderBy('pub_name', 'asc')->get();
        }
        return response()->json($publishers);
    }

    public function search_book_orgin_system(Request $request)
    {
        $query = $request->get('q');
        if ($query != '') {
            $origins = BookOrigin::select('bk_orgn_id', 'bk_orgn_name')
                ->where('bk_orgn_name', 'like', "%$query%")
                ->orderBy('bk_orgn_name', 'asc')
                ->get();
        } else {
            $origins = BookOrigin::select('bk_orgn_id', 'bk_orgn_name')->orderBy('bk_orgn_name', 'asc')->get();
        }
        return response()->json($origins);
    }

    public function search_book_ddc_system(Request $request)
    {
        $query = $request->get('q');
        $ddc = DeweyDecimalClassfication::select('ddc_id', 'ddc_code')
            ->where('ddc_code', 'like', "%$query%")
            ->orderBy('ddc_code', 'asc')
            ->get();
        return response()->json($ddc);
    }

    public function detail_book_page($id)
    {
        $book = Book::withTrashed()
            ->with(
                'authors:athr_id,athr_name',
                'origin:bk_orgn_id,bk_orgn_name',
                'major:bk_mjr_id,bk_mjr_class,bk_mjr_major',
                'publisher:pub_id,pub_name,pub_address',
                'bookCopies:bk_cp_id,bk_cp_book_id,bk_cp_number,bk_cp_status',
                'deweyDecimalClassfications:ddc_id,ddc_code',
                'origin:bk_orgn_id,bk_orgn_name',
                'created_by',
                'updated_by',
                'deleted_by',
            )
            ->find($id);
        $last_copy = BookCopy::select('bk_cp_id', 'bk_cp_number')
            ->where('bk_cp_book_id', $id)
            ->latest()
            ->first();

        $letters = null;

        if ($last_copy && $last_copy->bk_cp_number) {
            preg_match('/^([A-Za-z]+)/', $last_copy->bk_cp_number, $matches);
            $letters = $matches[1] ?? null;
        }
        return view('book.detail', ['title' => 'Halaman detail buku'], compact('book', 'letters'));
    }

    public function add_book_page()
    {
        $publishers = Publisher::orderBy('pub_name', 'asc')->get();
        $majors = BookMajor::orderBy('bk_mjr_class', 'asc')->get();
        return view('book.add', ['title' => 'Halaman tambah buku'], compact('publishers', 'majors'));
    }

    public function add_book_system(Request $request)
    {
        $message = [
            'bk_isbn.regex' => 'Format ISBN tidak valid.',
            'bk_isbn.unique' => 'Nomor ISBN sudah digunakan.',
            'bk_isbn.max' => 'ISBN memiliki maksimal :max karakter.',
            'bk_title.required' => 'Judul buku wajib diisi.',
            'bk_title.max' => 'Judul buku memiliki maksimal :max karakter.',
            'bk_description.max' => 'Deskripsi tidak boleh lebih dari 65535 karakter.',
            'bk_page.integer' => 'Jumlah halaman harus berupa angka.',
            'bk_page.max' => 'Jumlah halaman terlalu besar.',
            'bk_type.in' => 'Tipe buku tidak valid.',
            'bk_permission.in' => 'Jenis izin buku tidak valid.',
            'bk_unit_price.integer' => 'Harga satuan harus berupa angka.',
            'bk_published_year.digits' => 'Tahun terbit harus 4 digit.',
            'bk_published_year.max' => 'Tahun terbit tidak boleh melebihi tahun sekarang.',
            'bk_published_year.min' => 'Tahun terbit tidak boleh kurang dari :min tahun.',
            'bk_publisher_id.exists' => 'Penerbit tidak ditemukan.',
            'bk_major_id.exists' => 'Jurusan tidak ditemukan.',
            'bk_origin_id.exists' => 'Sumber tidak ditemukan.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 4MB.',
            'file_pdf.mimes' => 'File harus berupa PDF.',
            'file_pdf.max' => 'Ukuran file PDF maksimal 4MB.',
        ];

        $validateData = $request->validate([
            'bk_isbn' => ['nullable', ' max:255', 'regex:/^(97(8|9)[-\s]?)?\d{1,5}[-\s]?\d{1,7}[-\s]?\d{1,7}[-\s]?(\d|X)$/', 'unique:books,bk_isbn'],
            'bk_title' => 'required | string | max:255',
            'bk_description' => 'nullable | string | max:65535',
            'bk_page' => 'nullable | integer | max:9999999999 | min:0',
            'bk_type' => 'nullable | in:1,2',
            'bk_permission' => 'nullable | in:1,2',
            'bk_unit_price' => 'nullable | integer | max:9999999999 | min:0',
            'bk_edition_volume' => 'nullable | string | max:255',
            'bk_published_year' => 'nullable | digits:4 | integer | min:1901 | max:' . date('Y'),
            'bk_publisher_id' => 'nullable | min:0 | exists:publishers,pub_id',
            'bk_major_id' => 'nullable | integer | min:0 | exists:book_majors,bk_mjr_id',
            'bk_origin_id' => 'nullable | integer | min:0 | exists:book_origins,bk_orgn_id',
            'image' => 'nullable|image|max:4096',
            'file_pdf' => 'nullable|file|mimes:pdf|max:4096',
        ], $message);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('media/book_cover_img/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move($destinationPath, $filename);

            $validateData['bk_img_url'] = 'media/book_cover_img/' . $filename;
            $validateData['bk_img_public_id'] = $filename;
        }

        if ($request->hasFile('file_pdf')) {
            $destinationPath = public_path('media/ebook_pdf');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('file_pdf')->getClientOriginalName();
            $request->file('file_pdf')->move($destinationPath, $filename);

            $validateData['bk_file_url'] = 'media/ebook_pdf/' . $filename;
            $validateData['bk_file_public_id'] = $filename;

            $pdfFilePath = $destinationPath . '/' . $filename;
            $pdfToImage = new PdfToImage($pdfFilePath);

            $totalPages = $pdfToImage->getNumberOfPages();

            $safeTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->bk_title);
            $destinationPathPdf = public_path('media/pdf-image/' . $safeTitle);

            if (!file_exists($destinationPathPdf)) {
                mkdir($destinationPathPdf, 0777, true);
            }

            for ($i = 1; $i <= $totalPages; $i++) {
                $imagePath = $destinationPathPdf . "/page-{$i}.jpg";
                $pdfToImage->setPage($i)->saveImage($imagePath);
            }
        }

        $messageAthr = [
            'authors.array' => 'Format jurusan tidak valid.',
            'authors.min' => 'jurusan tidak boleh kurang dari :min.',
            'authors.*.exists' => 'Sumber tidak ditemukan.',
        ];

        $book = Book::create($validateData);
        if ($request->has('authors')) {
            $validateDataAuthor = $request->validate([
                'authors' => 'required|array|min:1',
                'authors.*' => 'exists:authors,athr_id',
            ], $messageAthr);

            $book->authors()->sync($validateDataAuthor['authors']);
        }

        $messageDDC = [
            'classfications.array' => 'Format jurusan tidak valid.',
            'classfications.min' => 'jurusan tidak boleh kurang dari :min.',
            'classfications.*.exists' => 'Sumber tidak ditemukan.',
        ];

        if ($request->has('classfications')) {
            $validateDataDDC = $request->validate([
                'classfications' => 'required|array|min:1',
                'classfications.*' => 'exists:dewey_decimal_classfications,ddc_id',
            ], $messageDDC);

            $book->deweyDecimalClassfications()->sync($validateDataDDC['classfications']);
        }

        return redirect('/manage/book')->with('success', 'Buku berhasik ditambahkan');
    }

    public function edit_book_page($id)
    {
        $book = Book::with(
            'authors:athr_id,athr_name',
            'origin:bk_orgn_id,bk_orgn_name',
            'major:bk_mjr_id,bk_mjr_class,bk_mjr_major',
            'publisher:pub_id,pub_name',
            'deweyDecimalClassfications:ddc_id,ddc_code',
        )
            ->select(
                'bk_id',
                'bk_isbn',
                'bk_title',
                'bk_description',
                'bk_page',
                'bk_img_url',
                'bk_type',
                'bk_file_url',
                'bk_permission',
                'bk_unit_price',
                'bk_edition_volume',
                'bk_published_year',
                'bk_edition_volume',
                'bk_publisher_id',
                'bk_major_id',
                'bk_origin_id',
            )
            ->find($id);
        $publishers = Publisher::orderBy('pub_name', 'asc')->get();
        $majors = BookMajor::orderBy('bk_mjr_class', 'asc')->get();
        return view('book.edit', ['title' => 'Halaman ubah buku'], compact('publishers', 'majors', 'book'));
    }

    public function edit_book_system(Request $request, $id)
    {

        $messageD = [
            'bk_title.required' => 'Judul buku wajib diisi.',
            'bk_title.max' => 'Judul buku memiliki maksimal :max karakter.',
            'bk_description.max' => 'Deskripsi tidak boleh lebih dari 65535 karakter.',
            'bk_page.integer' => 'Jumlah halaman harus berupa angka.',
            'bk_page.max' => 'Jumlah halaman terlalu besar.',
            'bk_type.in' => 'Tipe buku tidak valid.',
            'bk_permission.in' => 'Jenis izin buku tidak valid.',
            'bk_unit_price.integer' => 'Harga satuan harus berupa angka.',
            'bk_published_year.digits' => 'Tahun terbit harus 4 digit.',
            'bk_published_year.max' => 'Tahun terbit tidak boleh melebihi tahun sekarang.',
            'bk_published_year.min' => 'Tahun terbit tidak boleh kurang dari :min tahun.',
            'bk_publisher_id.exists' => 'Penerbit tidak ditemukan.',
            'bk_major_id.exists' => 'Jurusan tidak ditemukan.',
            'bk_origin_id.exists' => 'Sumber tidak ditemukan.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 4MB.',
            'file_pdf.mimes' => 'File harus berupa PDF.',
            'file_pdf.max' => 'Ukuran file PDF maksimal 4MB.',
        ];

        $messageISBN = [
            'bk_isbn.regex' => 'Format ISBN tidak valid.',
            'bk_isbn.unique' => 'Nomor ISBN sudah digunakan.',
            'bk_isbn.max' => 'ISBN memiliki maksimal :max karakter.',
        ];

        $book = Book::find($id);
        $validateData = $request->validate([
            'bk_title' => 'sometimes | required | string | max:255',
            'bk_description' => 'sometimes | nullable | string | max:65535',
            'bk_page' => 'nullable | integer | max:9999999999 | min:0',
            'bk_type' => 'sometimes | nullable | in:1,2',
            'bk_permission' => 'sometimes | nullable | in:1,2',
            'bk_unit_price' => 'sometimes | nullable | integer | max:9999999999 | min:0',
            'bk_edition_volume' => 'sometimes | nullable | string | max:255',
            'bk_published_year' => 'sometimes | nullable | digits:4 | integer | max:' . date('Y'),
            'bk_publisher_id' => 'sometimes | nullable | exists:publishers,pub_id',
            'bk_major_id' => 'sometimes | integer | min:0 | nullable | exists:book_majors,bk_mjr_id',
            'bk_origin_id' => 'nullable | integer | min:0 | exists:book_origins,bk_orgn_id',
            'image' => 'sometimes|nullable|image|max:4096',
            'file_pdf' => 'sometimes|nullable|file|mimes:pdf|max:4096',
        ], $messageD);

        if ($request->bk_isbn != $book['bk_isbn']) {
            $no_wa = $request->validate([
                'bk_isbn' => ['sometimes', 'nullable', ' max:255', 'regex:/^(97(8|9)[-\s]?)?\d{1,5}[-\s]?\d{1,7}[-\s]?\d{1,7}[-\s]?(\d|X)$/', 'unique:books,bk_isbn'],
            ], $messageISBN);
            $validateData['bk_isbn'] = $no_wa['bk_isbn'];
        }

        if ($request->hasFile('image')) {
            $destinationPath = public_path('media/book_cover_img/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move($destinationPath, $filename);

            $validateData['bk_img_url'] = 'media/book_cover_img/' . $filename;
            $validateData['bk_img_public_id'] = $filename;
        }

        if ($request->hasFile('file_pdf')) {
            if (!empty($book->bk_file_url)) {
                $oldPdfPath = public_path($book->bk_file_url);
                if (file_exists($oldPdfPath)) {
                    unlink($oldPdfPath);
                }
            }

            $oldSafeTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $book->bk_title);
            $oldImageDir = public_path('media/pdf-image/' . $oldSafeTitle);

            if (file_exists($oldImageDir)) {
                $this->deleteDirectory($oldImageDir);
            }

            $destinationPath = public_path('media/ebook_pdf');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('file_pdf')->getClientOriginalName();
            $request->file('file_pdf')->move($destinationPath, $filename);

            $validateData['bk_file_url'] = 'media/ebook_pdf/' . $filename;
            $validateData['bk_file_public_id'] = $filename;

            $pdfFilePath = $destinationPath . '/' . $filename;
            $pdfToImage = new PdfToImage($pdfFilePath);
            $totalPages = $pdfToImage->getNumberOfPages();

            $safeTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->bk_title);
            $destinationPathPdf = public_path('media/pdf-image/' . $safeTitle);

            if (!file_exists($destinationPathPdf)) {
                mkdir($destinationPathPdf, 0777, true);
            }

            for ($i = 1; $i <= $totalPages; $i++) {
                $imagePath = $destinationPathPdf . "/page-{$i}.jpg";
                $pdfToImage->setPage($i)->saveImage($imagePath);
            }
        }

        $book->update($validateData);
        $book->authors()->detach();

        $messageAthr = [
            'authors.array' => 'Format jurusan tidak valid.',
            'authors.min' => 'jurusan tidak boleh kurang dari :min.',
            'authors.*.exists' => 'Sumber tidak ditemukan.',
        ];

        if ($request->has('authors')) {
            $validateDataAuthor = $request->validate([
                'authors' => 'sometimes|required|array|min:1',
                'authors.*' => 'sometimes|exists:authors,athr_id',
            ], $messageAthr);

            $book->authors()->sync($validateDataAuthor['authors']);
        }

        $messageDDC = [
            'classfications.array' => 'Format jurusan tidak valid.',
            'classfications.min' => 'jurusan tidak boleh kurang dari :min.',
            'classfications.*.exists' => 'Sumber tidak ditemukan.',
        ];

        $book->deweyDecimalClassfications()->detach();
        if ($request->has('classfications')) {
            $validateDataDDC = $request->validate([
                'classfications' => 'sometimes|required|array|min:1',
                'classfications.*' => 'sometimes|exists:dewey_decimal_classfications,ddc_id',
            ], $messageDDC);

            $book->deweyDecimalClassfications()->sync($validateDataDDC['classfications']);
        }

        return redirect('/manage/book/' . $id . '/detail')->with('success', 'Buku berhasil diubah');
    }

    public function delete_book_system(Request $request, $id)
    {
        $book = Book::find($id);
        $book->deweyDecimalClassfications()->detach();
        $book->authors()->detach();
        $book->delete();
        return redirect('/manage/book')->with('success', 'Buku berhasil dihapus');
    }

    public function add_book_copy_system(Request $request, $id)
    {

        $message = [
            'code.required' => 'Kode salinan wajib diisi.',
            'number.required' => 'Nomor salinan wajib diisi.',
            'number.integer' => 'Nomor salinan harus berupa angka.',
            'number.min' => 'Nomor salinan tidak boleh negatif.',
        ];

        $request->validate([
            'code' => 'required | string | max:255',
            'number' => 'required | integer | min:0',
        ], $message);

        $str = BookCopy::select('bk_cp_number')
            ->where('bk_cp_book_id', $id)
            ->orderByRaw(
                "
        CAST(SUBSTRING_INDEX(bk_cp_number, '-', -1) AS UNSIGNED) DESC",
            )
            ->first();
        $parts = explode('-', $str);
        $number = 1;
        if ($str != null) {
            $number = (int) $parts[1] + 1;
        }
        for ($i = 0; $i < $request->number; $i++) {
            BookCopy::create([
                'bk_cp_book_id' => $id,
                'bk_cp_number' => $request->code . '-' . $number++,
                'bk_cp_status' => '1',
            ]);
        }
        return redirect('/manage/book/' . $id . '/detail#bk_cp')->with('success', 'Salinan berhasil ditambahkan');
    }

    public function edit_book_copy_system(Request $request, $id)
    {
        $copy = BookCopy::find($id);

        $validateData = $request->validate([
            'bk_cp_status' => 'sometimes | required | in:1,2,3,4',
        ]);

        $copy->update($validateData);
        return redirect('/manage/book/' . $request->book_id . '/detail#bk_cp')->with('success', 'Salinan berhasil diubah');
    }

    public function delete_book_copy_system(Request $request, $id)
    {
        $copy = BookCopy::find($id);
        $copy->delete();
        return redirect('/manage/book/' . $request->book_id . '/detail#bk_cp')->with('success', 'Salinan berhasil dihapus');
    }

    public function delete_many_book_copy_system(Request $request)
    {
        $request->validate([
            'copy_ids' => 'required|array',
        ]);

        $copies = BookCopy::whereIn('bk_cp_id', $request->copy_ids);
        $deletedCount = $copies->delete();

        return back()->with('success', "{$deletedCount} salinan berhasil dihapus.");
    }

    public function manage_book_major_page(Request $request)
    {
        $query = $request->get('s');
        $majors = BookMajor::select('bk_mjr_id', 'bk_mjr_class', 'bk_mjr_major')
            ->where('bk_mjr_major', 'like', "%$query%")
            ->latest()
            ->paginate(10);
        return view('book.major.view', ['title' => 'Halaman kelola jurusan'], compact('majors'));
    }

    public function detail_book_major_page($id)
    {
        $major = BookMajor::withTrashed()->with('created_by:usr_id,name', 'updated_by:usr_id,name', 'deleted_by:usr_id,name')->find($id);
        return view('book.major.detail', ['title' => 'Halaman detail jurusan'], compact('major'));
    }

    public function add_book_major_page()
    {
        return view('book.major.add', ['title' => 'Halaman tambah jurusan']);
    }

    public function add_book_major_system(Request $request)
    {

        $message = [
            'bk_mjr_class.required' => 'Kelas jurusan wajib diisi.',
            'bk_mjr_class.in' => 'Tipe jurusan tidak valid.',
            'bk_mjr_major.required' => 'Nama jurusan wajib diisi.',
            'bk_mjr_major.max' => 'Nama jurusan terlalu panjang.',
        ];

        $validateData = $request->validate([
            'bk_mjr_class' => 'required | in:1,2,3',
            'bk_mjr_major' => 'required | string | max:255',
        ], $message);

        BookMajor::create($validateData);
        return redirect('/manage/major')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function edit_book_major_page($id)
    {
        $major = BookMajor::select('bk_mjr_id', 'bk_mjr_class', 'bk_mjr_major')->find($id);
        return view('book.major.edit', ['title' => 'Halaman ubah jurusan'], compact('major'));
    }

    public function edit_book_major_system(Request $request, $id)
    {
        $major = BookMajor::find($id);

        $message = [
            'bk_mjr_class.required' => 'Kelas jurusan wajib diisi.',
            'bk_mjr_class.in' => 'Tipe jurusan tidak valid.',
            'bk_mjr_major.required' => 'Nama jurusan wajib diisi.',
            'bk_mjr_major.max' => 'Nama jurusan terlalu panjang.',
        ];

        $validateData = $request->validate([
            'bk_mjr_class' => 'sometimes | required | in:1,2,3',
            'bk_mjr_major' => 'sometimes | required | string | max:255',
        ], $message);

        $major->update($validateData);
        return redirect('/manage/major')->with('success', 'Jurusan berhasil diubah');
    }

    public function delete_book_major_system($id)
    {
        BookMajor::find($id)->delete();
        return redirect('/manage/major')->with('success', 'Jurusan berhasil dihapus');
    }

    public function manage_book_author_page(Request $request)
    {
        $query = $request->get('s');
        $authors = Author::select('athr_id', 'athr_name')
            ->where('athr_name', 'like', "%$query%")
            ->latest()
            ->paginate(10);
        return view('book.author.view', ['title' => 'Halaman kelola penulis'], compact('authors'));
    }

    public function detail_book_author_page($id)
    {
        $author = Author::withTrashed()->with('created_by:usr_id,name', 'updated_by:usr_id,name', 'deleted_by:usr_id,name')->find($id);
        return view('book.author.detail', ['title' => 'Halaman detail penulis'], compact('author'));
    }

    public function add_book_author_page()
    {
        return view('book.author.add', ['title' => 'Halaman tambah penulis']);
    }

    public function add_book_author_system(Request $request)
    {

        $message = [
            'athr_name.required' => 'Nama penulis wajib diisi.',
        ];

        $validateData = $request->validate([
            'athr_name' => 'required | string | max:255',
        ], $message);

        Author::create($validateData);
        return redirect('/manage/author')->with('success', 'Penulis berhasil ditambahkan');
    }

    public function edit_book_author_page($id)
    {
        $authors = Author::select('athr_id', 'athr_name')->find($id);
        return view('book.author.edit', ['title' => 'Halaman ubah penulis'], compact('authors'));
    }

    public function edit_book_author_system(Request $request, $id)
    {
        $author = Author::find($id);

        $message = [
            'athr_name.required' => 'Nama penulis wajib diisi.',
        ];

        $validateData = $request->validate([
            'athr_name' => 'sometimes | required | string | max:255',
        ], $message);

        $author->update($validateData);
        return redirect('/manage/author')->with('success', 'Penulis berhasil diubah');
    }

    public function delete_book_author_system(Request $request, $id)
    {
        $author = Author::find($id);

        $author->delete();
        return redirect('/manage/author')->with('success', 'Penulis berhasil dihupus');
    }

    public function manage_book_publisher_page(Request $request)
    {
        $query = $request->get('s');
        $publishers = Publisher::select('pub_id', 'pub_name', 'pub_address')
            ->where('pub_name', 'like', "%$query%")
            ->latest()
            ->paginate(10);
        return view('book.publisher.view', ['title' => 'Halaman kelola penerbit'], compact('publishers'));
    }

    public function detail_book_publisher_page($id)
    {
        $publisher = Publisher::with('created_by', 'updated_by', 'deleted_by')->withTrashed()->find($id);
        return view('book.publisher.detail', ['title' => 'Halaman detail penerbit'], compact('publisher'));
    }

    public function pdf_book_page($id)
    {
        $book = Book::select('bk_id', 'bk_title', 'bk_file_url')->find($id);

        $safeTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $book->bk_title);
        $folderPath = public_path('media/pdf-image/' . $safeTitle);

        $images = [];
        if (file_exists($folderPath)) {
            $files = File::files($folderPath);
            sort($files);
            foreach ($files as $file) {
                $images[] = asset('media/pdf-image/' . $safeTitle . '/' . basename($file));
            }
        }
        return view('book.pdf', ['title' => 'Halaman detail Ebuku'], compact('book', 'images'));
    }

    public function add_book_publisher_page()
    {
        return view('book.publisher.add', ['title' => 'Halaman tambah penerbit']);
    }

    public function add_book_publisher_system(Request $request)
    {

        $message = [
            'pub_name.required' => 'Nama penerbit wajib diisi.',
        ];

        $validateData = $request->validate([
            'pub_name' => 'required | string | max:255',
            'pub_address' => 'nullable | string | max:255',
        ], $message);

        Publisher::create($validateData);
        return redirect('/manage/publisher')->with('success', 'Penerbit berhasil ditambahkan');
    }

    public function edit_book_publisher_page($id)
    {
        $publishers = Publisher::select('pub_id', 'pub_name', 'pub_address')->find($id);
        return view('book.publisher.edit', ['title' => 'Halaman uabh penerbit'], compact('publishers'));
    }

    public function edit_book_publisher_system(Request $request, $id)
    {
        $publisher = Publisher::find($id);

        $message = [
            'pub_name.required' => 'Nama penerbit wajib diisi.',
        ];

        $validateData = $request->validate([
            'pub_name' => 'sometimes | required | string | max:255',
            'pub_address' => 'sometimes | nullable | string | max:255',
        ], $message);

        $publisher->update($validateData);
        return redirect('/manage/publisher')->with('success', 'Penerbit berhasil diubah');
    }

    public function delete_book_publisher_system(Request $request, $id)
    {
        $author = Publisher::find($id);

        $author->delete();
        return redirect('/manage/publisher')->with('success', 'Penerbit berhasil dihapus');
    }

    public function manage_book_classfication_page(Request $request)
    {
        $query = $request->get('s');
        $classfications = DeweyDecimalClassfication::select('ddc_id', 'ddc_code', 'ddc_description')
            ->where('ddc_code', 'like', "%$query%")
            ->latest()
            ->paginate(10);
        return view('book.classfication.view', ['title' => 'Halaman kelola klasifikasi'], compact('classfications'));
    }

    public function detail_book_classfication_page($id)
    {
        $classfication = DeweyDecimalClassfication::withTrashed()->with('created_by', 'updated_by', 'deleted_by')->find($id);
        return view('book.classfication.detail', ['title' => 'Halaman ubah klasifikasi'], compact('classfication'));
    }

    public function add_book_classfication_page()
    {
        return view('book.classfication.add', ['title' => 'Halaman tambah klasifikasi']);
    }

    public function add_book_classfication_system(Request $request)
    {

        $message = [
            'ddc_code.required' => 'Kode DDC wajib diisi.',
            'ddc_code.regex' => 'Format kode DDC tidak valid.',
            'ddc_description.required' => 'Deskripsi DDC wajib diisi.',
        ];

        $validateData = $request->validate([
            'ddc_code' => 'required | regex:/^\d+(\.\d+)?$/ | max:255 | unique:dewey_decimal_classfications,ddc_id',
            'ddc_description' => 'required | string | max:65535',
        ], $message);

        DeweyDecimalClassfication::create($validateData);
        return redirect('/manage/ddc')->with('success', 'Klasifikasi berhasil ditambahkan');
    }

    public function edit_book_classfication_page($id)
    {
        $classfications = DeweyDecimalClassfication::select('ddc_id', 'ddc_code', 'ddc_description')->find($id);
        return view('book.classfication.edit', ['title' => 'Halaman ubah klasifikasi'], compact('classfications'));
    }

    public function edit_book_classfication_system(Request $request, $id)
    {
        $classfication = DeweyDecimalClassfication::find($id);

        $message = [
            'ddc_code.required' => 'Kode DDC wajib diisi.',
            'ddc_code.regex' => 'Format kode DDC tidak valid.',
            'ddc_description.required' => 'Deskripsi DDC wajib diisi.',
        ];

        $validateData = $request->validate([
            'ddc_code' => 'sometimes | required | regex:/^\d+(\.\d+)?$/ | max:255',
            'ddc_description' => 'sometimes | required | string | max:65535',
        ], $message);

        $classfication->update($validateData);
        return redirect('/manage/ddc')->with('success', 'Klasifikasi berhasil diubah');
    }

    public function delete_book_classfication_system(Request $request, $id)
    {
        $classfication = DeweyDecimalClassfication::find($id);

        $classfication->delete();
        return redirect('/manage/ddc')->with('success', 'Klasifikasi berhasil dihapus');
    }

    public function manage_book_origin_page(Request $request)
    {
        $query = $request->get('s');
        $origins = BookOrigin::select('bk_orgn_id', 'bk_orgn_name')
            ->where('bk_orgn_name', 'like', "%$query%")
            ->latest()
            ->paginate(10);
        return view('book.origin.view', ['title' => 'Halaman kelola sumber'], compact('origins'));
    }

    public function detail_book_origin_page($id)
    {
        $origin = BookOrigin::withTrashed()->with('created_by:usr_id,name', 'updated_by:usr_id,name', 'deleted_by:usr_id,name')->find($id);
        return view('book.origin.detail', ['title' => 'Halaman detail sumber'], compact('origin'));
    }

    public function add_book_origin_page()
    {
        return view('book.origin.add', ['title' => 'Halaman tambah sumber']);
    }

    public function add_book_origin_system(Request $request)
    {

        $message = [
            'bk_orgn_name.required' => 'Nama sumber buku wajib diisi.',
        ];

        $validateData = $request->validate([
            'bk_orgn_name' => 'required | string | max:255 | unique:book_origins,bk_orgn_name',
        ], $message);

        BookOrigin::create($validateData);
        return redirect('/manage/origin')->with('success', 'Sumber berhasil ditambahkan');
    }

    public function edit_book_origin_page($id)
    {
        $origin = BookOrigin::select('bk_orgn_id', 'bk_orgn_name')->find($id);
        return view('book.origin.edit', ['title' => 'Halaman ubah sumber'], compact('origin'));
    }

    public function edit_book_origin_system(Request $request, $id)
    {
        $origin = BookOrigin::find($id);

        $message = [
            'bk_orgn_name.required' => 'Nama sumber buku wajib diisi.',
        ];

        $validateData = $request->validate([
            'bk_orgn_name' => 'sometimes | required | string | max:255',
        ], $message);
        $origin->update($validateData);
        return redirect('/manage/origin')->with('success', 'Sumber berhasil diubah');
    }

    public function delete_book_origin_system(Request $request, $id)
    {
        $origin = BookOrigin::find($id)->delete();
        return redirect('/manage/origin')->with('success', 'Sumber berhasil dihapus');
    }

    public function print_label_system($id)
    {
        $books = Book::withTrashed()
            ->with(
                'authors:athr_id,athr_name',
                'origin:bk_orgn_id,bk_orgn_name',
                'major:bk_mjr_id,bk_mjr_class,bk_mjr_major',
                'publisher:pub_id,pub_name',
                'bookCopies:bk_cp_id,bk_cp_book_id,bk_cp_number,bk_cp_status',
                'deweyDecimalClassfications:ddc_id,ddc_code',
                'origin:bk_orgn_id,bk_orgn_name',
                'created_by',
                'updated_by',
                'deleted_by',
            )
            ->find($id);

        $path = storage_path('app/public/labels.pdf');
        $html = view('book.print_label', compact('books'))->render();

        Browsershot::html($html)->showBackground()->format('A4')->margins(10, 10, 10, 10)->save($path);

        return response()->download($path);
    }

    private function deleteDirectory($dirPath)
    {
        if (!is_dir($dirPath)) {
            return;
        }

        $files = array_diff(scandir($dirPath), ['.', '..']);

        foreach ($files as $file) {
            $filePath = $dirPath . DIRECTORY_SEPARATOR . $file;
            if (is_dir($filePath)) {
                $this->deleteDirectory($filePath);
            } else {
                unlink($filePath);
            }
        }

        rmdir($dirPath);
    }
}
