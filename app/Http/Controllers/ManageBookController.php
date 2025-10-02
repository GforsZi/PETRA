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

class ManageBookController extends Controller
{
    public function manage_book_page()
    {
        $books = Book::select('bk_id', 'bk_title', 'bk_img_url', 'bk_type', 'bk_published_year', 'bk_publisher_id')->with('publisher:pub_id,pub_name', 'authors:athr_id,athr_name')->latest()->paginate(12);
        return view('book.view', ['title' => 'Halaman Kelola Buku'], compact('books'));
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
            $publishers = Publisher::select('pub_id', 'pub_name')
                ->orderBy('pub_name', 'asc')
                ->get();
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
            $origins = BookOrigin::select('bk_orgn_id', 'bk_orgn_name')
                ->orderBy('bk_orgn_name', 'asc')
                ->get();
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
        $book = Book::withTrashed()->with('authors:athr_id,athr_name', 'origin:bk_orgn_id,bk_orgn_name', 'major:bk_mjr_id,bk_mjr_class,bk_mjr_major', 'publisher:pub_id,pub_name', 'bookCopies:bk_cp_id,bk_cp_book_id,bk_cp_number,bk_cp_status', 'deweyDecimalClassfications:ddc_id,ddc_code', 'origin:bk_orgn_id,bk_orgn_name', 'created_by', 'updated_by', 'deleted_by')->find($id);
        return view('book.detail', ['title' => 'Halaman Detail Buku'], compact('book'));
    }

    public function add_book_page()
    {
        $publishers = Publisher::orderBy('pub_name', 'asc')->get();
        $majors = BookMajor::orderBy('bk_mjr_class', 'asc')->get();
        return view('book.add', ['title' => 'Halaman Tambah Buku'], compact('publishers', 'majors'));
    }

    public function add_book_system(Request $request)
    {
        $validateData = $request->validate([
            'bk_isbn' => ['nullable', ' max:255', 'regex:/^(97(8|9)[-\s]?)?\d{1,5}[-\s]?\d{1,7}[-\s]?\d{1,7}[-\s]?(\d|X)$/', 'unique:books,bk_isbn'],
            'bk_title' => 'required | string | max:255',
            'bk_description' => 'nullable | string | max:65535',
            'bk_page' => 'nullable | integer | max:9999999',
            'bk_type' => 'nullable | in:1,2',
            'bk_unit_price' => 'nullable | integer | max:999999999',
            'bk_edition_volume' => 'nullable | string | max:255',
            'bk_published_year' => 'nullable | digits:4 | integer | max:' . date('Y'),
            'bk_publisher_id' => 'nullable | exists:publishers,pub_id',
            'bk_major_id' => 'nullable | exists:book_majors,bk_mjr_id',
            'bk_origin_id' => 'nullable | exists:book_origins,bk_orgn_id',
            'image' => 'nullable|image|max:2048',
            'file_pdf' => 'nullable|file|mimes:pdf|max:6144',
        ]);

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
            $destinationPath = public_path('media/ebook_pdf/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('file_pdf')->getClientOriginalName();

            $request->file('file_pdf')->move($destinationPath, $filename);

            $validateData['bk_file_url'] = 'media/ebook_pdf/' . $filename;
            $validateData['bk_file_public_id'] = $filename;
        }

        $book = Book::create($validateData);
        if ($request->has('authors')) {
            $validateDataAuthor = $request->validate([
                'authors' => 'required|array|min:1',
                'authors.*' => 'exists:authors,athr_id',
            ]);

            $book->authors()->sync($validateDataAuthor['authors']);
        }

        if ($request->has('classfications')) {
            $validateDataDDC = $request->validate([
                'classfications' => 'required|array|min:1',
                'classfications.*' => 'exists:dewey_decimal_classfications,ddc_id',
            ]);

            $book->deweyDecimalClassfications()->sync($validateDataDDC['classfications']);
        }

        return redirect('/manage/book/')->with('success', 'Buku Berhasil Ditambahkan');
    }

    public function edit_book_page($id)
    {
        $book = Book::with('authors:athr_id,athr_name', 'origin:bk_orgn_id,bk_orgn_name', 'major:bk_mjr_id,bk_mjr_class,bk_mjr_major', 'publisher:pub_id,pub_name', 'deweyDecimalClassfications:ddc_id,ddc_code')->select('bk_id', 'bk_isbn', 'bk_title', 'bk_description', 'bk_page', 'bk_img_url', 'bk_type', 'bk_file_url', 'bk_unit_price', 'bk_edition_volume', 'bk_published_year', 'bk_edition_volume', 'bk_publisher_id', 'bk_major_id', 'bk_origin_id')->find($id);
        $publishers = Publisher::orderBy('pub_name', 'asc')->get();
        $majors = BookMajor::orderBy('bk_mjr_class', 'asc')->get();
        return view('book.edit', ['title' => 'Halaman Ubah Buku'], compact('publishers', 'majors', 'book'));
    }

    public function edit_book_system(Request $request, $id)
    {
        $book = Book::find($id);
        $validateData = $request->validate([
            'bk_title' => 'sometimes | required | string | max:255',
            'bk_description' => 'sometimes | nullable | string | max:65535',
            'bk_page' => 'nullable | integer | max:9999999',
            'bk_type' => 'sometimes | nullable | in:1,2',
            'bk_unit_price' => 'sometimes | nullable | integer | max:999999999',
            'bk_edition_volume' => 'sometimes | nullable | string | max:255',
            'bk_published_year' => 'sometimes | nullable | digits:4 | integer | max:' . date('Y'),
            'bk_publisher_id' => 'sometimes | nullable | exists:publishers,pub_id',
            'bk_major_id' => 'sometimes | nullable | exists:book_majors,bk_mjr_id',
            'bk_origin_id' => 'nullable | exists:book_origins,bk_orgn_id',
            'image' => 'sometimes|nullable|image|max:2048',
            'file_pdf' => 'sometimes|nullable|file|mimes:pdf|max:6144',
        ]);

        if ($request->bk_isbn != $book['bk_isbn']) {
            $no_wa = $request->validate([
                'bk_isbn' => ['sometimes', 'nullable', ' max:255', 'regex:/^(97(8|9)[-\s]?)?\d{1,5}[-\s]?\d{1,7}[-\s]?\d{1,7}[-\s]?(\d|X)$/', 'unique:books,bk_isbn'],
            ]);
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
            $destinationPath = public_path('media/ebook_pdf/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('file_pdf')->getClientOriginalName();

            $request->file('file_pdf')->move($destinationPath, $filename);

            $validateData['bk_file_url'] = 'media/ebook_pdf/' . $filename;
            $validateData['bk_file_public_id'] = $filename;
        }

        $book->update($validateData);
        $book->authors()->detach();
        if ($request->has('authors')) {
            $validateDataAuthor = $request->validate([
                'authors' => 'sometimes|required|array|min:1',
                'authors.*' => 'sometimes|exists:authors,athr_id',
            ]);

            $book->authors()->sync($validateDataAuthor['authors']);
        }

        $book->deweyDecimalClassfications()->detach();
        if ($request->has('classfications')) {
            $validateDataDDC = $request->validate([
                'classfications' => 'sometimes|required|array|min:1',
                'classfications.*' => 'sometimes|exists:dewey_decimal_classfications,ddc_id',
            ]);

            $book->deweyDecimalClassfications()->sync($validateDataDDC['classfications']);
        }

        return redirect('/manage/book/')->with('success', 'Buku Berhasil Diubah');
    }

    public function delete_book_system(Request $request, $id)
    {
        $book = Book::find($id);
        $book->deweyDecimalClassfications()->detach();
        $book->authors()->detach();
        $book->delete();
        return redirect('/manage/book')->with('success', 'Buku Berhasil Dihapus');
    }

    public function add_book_copy_system(Request $request, $id)
    {
        $request->validate([
            'code' => 'required | string | max:255',
            'number' => 'required | integer',
        ]);

        $str = BookCopy::select('bk_cp_number')->where('bk_cp_book_id', $id)->orderByRaw("
        CAST(SUBSTRING_INDEX(bk_cp_number, '-', -1) AS UNSIGNED) DESC")->first();
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
        return redirect('/manage/book/' . $id . '/detail#bk_cp')->with('success', 'Salinan Berhasil Ditambahkan');
    }

    public function edit_book_copy_system(Request $request, $id)
    {
        $copy = BookCopy::find($id);

        $validateData = $request->validate([
            'bk_cp_status' => 'sometimes | required | in:1,2,3,4',
        ]);

        $copy->update($validateData);
        return redirect('/manage/book/' . $request->book_id . '/detail#bk_cp')->with('success', 'Salinan Berhasil Diubah');
    }

    public function delete_book_copy_system(Request $request, $id)
    {
        $copy = BookCopy::find($id);
        $copy->delete();
        return redirect('/manage/book/' . $request->book_id . '/detail#bk_cp')->with('success', 'Salinan Berhasil Dihapus');
    }

    public function manage_book_major_page()
    {
        $majors = BookMajor::select('bk_mjr_id', 'bk_mjr_class', 'bk_mjr_major')->latest()->paginate(10);
        return view('book.major.view', ['title' => 'Halaman Kelola Jurusan'], compact('majors'));
    }

    public function detail_book_major_page($id)
    {
        $major = BookMajor::withTrashed()->with('created_by:usr_id,name', 'updated_by:usr_id,name', 'deleted_by:usr_id,name')->find($id);
        return view('book.major.detail', ['title' => 'Halaman Detail Jurusan'], compact('major'));
    }

    public function add_book_major_page()
    {
        return view('book.major.add', ['title' => 'Halaman Tambah Jurusan']);
    }

    public function add_book_major_system(Request $request)
    {
        $validateData = $request->validate([
            'bk_mjr_class' => 'required | regex:/^[0-9]+$/ | max:255',
            'bk_mjr_major' => 'required | string | max:255',
        ]);

        BookMajor::create($validateData);
        return redirect('/manage/book/major')->with('success', 'Jurusan Berhail Ditambahkan');
    }

    public function edit_book_major_page($id)
    {
        $major = BookMajor::select('bk_mjr_id', 'bk_mjr_class', 'bk_mjr_major')->find($id);
        return view('book.major.edit', ['title' => 'Halaman Ubah Jurusan'], compact('major'));
    }

    public function edit_book_major_system(Request $request, $id)
    {
        $major = BookMajor::find($id);
        $validateData = $request->validate([
            'bk_mjr_class' => 'sometimes | required | regex:/^[0-9]+$/ | max:255',
            'bk_mjr_major' => 'sometimes | required | string | max:255',
        ]);

        $major->update($validateData);
        return redirect('/manage/book/major')->with('success', 'Jurusan Berhail Diubah');
    }

    public function delete_book_major_system($id)
    {
        BookMajor::find($id)->delete();
        return redirect('/manage/book/major')->with('success', 'Jurusan Berhail Dihapus');
    }

    public function manage_book_author_page()
    {
        $authors = Author::select('athr_id', 'athr_name')->latest()->paginate(10);
        return view('book.author.view', ['title' => 'Halaman Kelola Penulis'], compact('authors'));
    }

    public function detail_book_author_page($id)
    {
        $author = Author::withTrashed()->with('created_by:usr_id,name', 'updated_by:usr_id,name', 'deleted_by:usr_id,name')->find($id);
        return view('book.author.detail', ['title' => 'Halaman Kelola Penulis'], compact('author'));
    }

    public function add_book_author_page()
    {
        return view('book.author.add', ['title' => 'Halaman Tambha Penulis']);
    }

    public function add_book_author_system(Request $request)
    {
        $validateData = $request->validate([
            'athr_name' => 'required | string | max:255',
        ]);

        Author::create($validateData);
        return redirect('/manage/book/author')->with('success', 'Penulis Berhasil Ditambahkan');
    }

    public function edit_book_author_page($id)
    {
        $authors = Author::select('athr_id', 'athr_name')->find($id);
        return view('book.author.edit', ['title' => 'Halaman Ubah Penulis'], compact('authors'));
    }

    public function edit_book_author_system(Request $request, $id)
    {
        $author = Author::find($id);

        $validateData = $request->validate([
            'athr_name' => 'sometimes | required | string | max:255',
        ]);

        $author->update($validateData);
        return redirect('/manage/book/author')->with('success', 'Penulis Berhasil Diubah');
    }

    public function delete_book_author_system(Request $request, $id)
    {
        $author = Author::find($id);

        $author->delete();
        return redirect('/manage/book/author')->with('success', 'Penulis Berhasil Dihapus');
    }

    public function manage_book_publisher_page()
    {
        $publishers = Publisher::select('pub_id', 'pub_name', 'pub_address')->latest()->paginate(10);
        return view('book.publisher.view', ['title' => 'Halaman Kelola Penerbit'], compact('publishers'));
    }

    public function detail_book_publisher_page($id)
    {
        $publisher = Publisher::with('created_by', 'updated_by', 'deleted_by')->withTrashed()->find($id);
        return view('book.publisher.detail', ['title' => 'Halaman Detail Penerbit'], compact('publisher'));
    }

    public function pdf_book_publisher_page($id)
    {
        $book = Book::select('bk_id', 'bk_title', 'bk_file_url')->find($id);
        return view('book.pdf', ['title' => 'Halaman Detail Ebook'], compact('book'));
    }

    public function add_book_publisher_page()
    {
        return view('book.publisher.add', ['title' => 'Halaman Tambah Penerbit']);
    }

    public function add_book_publisher_system(Request $request)
    {
        $validateData = $request->validate([
            'pub_name' => 'required | string | max:255',
            'pub_address' => 'required | string | max:255',
        ]);

        Publisher::create($validateData);
        return redirect('/manage/book/publisher')->with('success', 'Penerbit Berhasil Ditambahkan');
    }

    public function edit_book_publisher_page($id)
    {
        $publishers = Publisher::select('pub_id', 'pub_name', 'pub_address')->find($id);
        return view('book.publisher.edit', ['title' => 'Halaman Ubah Penerbit'], compact('publishers'));
    }

    public function edit_book_publisher_system(Request $request, $id)
    {
        $publisher = Publisher::find($id);

        $validateData = $request->validate([
            'pub_name' => 'sometimes | required | string | max:255',
            'pub_address' => 'sometimes | required | string | max:255',
        ]);

        $publisher->update($validateData);
        return redirect('/manage/book/publisher')->with('success', 'Penerbit Berhasil Diubah');
    }

    public function delete_book_publisher_system(Request $request, $id)
    {
        $author = Publisher::find($id);

        $author->delete();
        return redirect('/manage/book/publisher')->with('success', 'Penerbit Berhasil Dihapus');
    }

    public function manage_book_classfication_page()
    {
        $classfications = DeweyDecimalClassfication::select('ddc_id', 'ddc_code', 'ddc_description')->latest()->paginate(10);
        return view('book.classfication.view', ['title' => 'Halaman Kelola Klasifikasi'], compact('classfications'));
    }

    public function detail_book_classfication_page($id)
    {
        $classfication = DeweyDecimalClassfication::withTrashed()->with('created_by', 'updated_by', 'deleted_by')->find($id);
        return view('book.classfication.detail', ['title' => 'Halaman Ubah Klasifikasi'], compact('classfication'));
    }

    public function add_book_classfication_page()
    {
        return view('book.classfication.add', ['title' => 'Halaman Tambah Klasifikasi']);
    }

    public function add_book_classfication_system(Request $request)
    {
        $validateData = $request->validate([
            'ddc_code' => 'required | regex:/^\d{3}-\d{3}$/ | max:255',
            'ddc_description' => 'required | string | max:65535',
        ]);

        DeweyDecimalClassfication::create($validateData);
        return redirect('/manage/book/ddc')->with('success', 'Klasifikasi Berhasil Ditambahkan');
    }

    public function edit_book_classfication_page($id)
    {
        $classfications = DeweyDecimalClassfication::select('ddc_id', 'ddc_code', 'ddc_description')->find($id);
        return view('book.classfication.edit', ['title' => 'Halaman Ubah Klasifikasi'], compact('classfications'));
    }

    public function edit_book_classfication_system(Request $request, $id)
    {
        $classfication = DeweyDecimalClassfication::find($id);

        $validateData = $request->validate([
            'ddc_code' => 'sometimes | required | regex:/^[0-9]+$/ | max:255',
            'ddc_description' => 'sometimes | required | string | max:65535',
        ]);

        $classfication->update($validateData);
        return redirect('/manage/book/ddc')->with('success', 'Klasifikasi Berhasil Diubah');
    }

    public function delete_book_classfication_system(Request $request, $id)
    {
        $classfication = DeweyDecimalClassfication::find($id);

        $classfication->delete();
        return redirect('/manage/book/ddc')->with('success', 'Klasifikasi Berhasil Dihapus');
    }

    public function manage_book_origin_page() {
        $origins = BookOrigin::select('bk_orgn_id', 'bk_orgn_name', 'bk_orgn_description')->latest()->paginate(10);
        return view('book.origin.view', ['title' => 'Halaman Kelola Asal Buku'], compact('origins'));
    }

    public function detail_book_origin_page($id) {
        $origin = BookOrigin::withTrashed()->with('created_by:usr_id,name', 'updated_by:usr_id,name', 'deleted_by:usr_id,name')->find($id);
        return view('book.origin.detail', ['title' => 'Halaman Detail Asal Buku'], compact('origin'));
    }

    public function add_book_origin_page() {
        return view('book.origin.add', ['title' => 'Halaman Tambah Asal Buku']);
    }

    public function add_book_origin_system(Request $request) {
        $validateData = $request->validate([
            'bk_orgn_name' => 'required | string | max:255',
            'bk_orgn_description' => 'nullable | string | max:65535'
        ]);

        BookOrigin::create($validateData);
        return redirect('/manage/book/origin')->with('success', 'Asal Buku Berhasil Ditambahkan');
    }

    public function edit_book_origin_page($id) {
        $origin = BookOrigin::select('bk_orgn_id', 'bk_orgn_name', 'bk_orgn_description')->find($id);
        return view('book.origin.edit', ['title' => 'Halaman Ubah Asal Buku'], compact('origin'));
    }

    public function edit_book_origin_system(Request $request, $id) {
        $origin = BookOrigin::find($id);
        $validateData = $request->validate([
            'bk_orgn_name' => 'sometimes | required | string | max:255',
            'bk_orgn_description' => 'sometimes | nullable | string | max:65535'
        ]);
        $origin->update($validateData);
        return redirect('/manage/book/origin')->with('success', 'Asal Buku Berhasil Diubah');
    }

    public function delete_book_origin_system(Request $request, $id) {
        $origin = BookOrigin::find($id)->delete();
        return redirect('/manage/book/origin')->with('success', 'Asal Buku Berhasil Dihapus');
    }

    public function print_label_system($id)
    {
        // Contoh data, bisa ambil dari DB
        $books = Book::withTrashed()->with('authors:athr_id,athr_name', 'origin:bk_orgn_id,bk_orgn_name', 'major:bk_mjr_id,bk_mjr_class,bk_mjr_major', 'publisher:pub_id,pub_name', 'bookCopies:bk_cp_id,bk_cp_book_id,bk_cp_number,bk_cp_status', 'deweyDecimalClassfications:ddc_id,ddc_code', 'origin:bk_orgn_id,bk_orgn_name', 'created_by', 'updated_by', 'deleted_by')->find($id);

        $path = storage_path('app/public/labels.pdf');
        $html = view('book.print_label', compact('books'))->render();

        Browsershot::html($html)
            ->format('A4')
            ->margins(10, 10, 10, 10) // margin 10mm
            ->save($path);

        return response()->download($path);

    }
}
