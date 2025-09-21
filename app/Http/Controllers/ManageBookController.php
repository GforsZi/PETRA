<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BookMajor;
use App\Models\DeweyDecimalClassfication;
use App\Models\Publisher;
use Illuminate\Http\Request;

class ManageBookController extends Controller
{
    public function manage_book_page() {
        return view('book.view', ['title' => 'Halaman Kelola Buku']);
    }

    public function detail_book_page($id) {
        return view('book.detail', ['title' => 'Halaman Detail Buku']);
    }

    public function add_book_page() {
        return view('book.add', ['title' => 'Halaman Tambah Buku']);
    }

    public function edit_book_page($id) {
        return view('book.edit', ['title' => 'Halaman Ubah Buku']);
    }

    public function manage_book_major_page() {
        $majors = BookMajor::select('bk_mjr_id', 'bk_mjr_class', 'bk_mjr_major')->latest()->paginate(10);
        return view('book.major.view', ['title' => 'Halaman Kelola Jurusan'], compact('majors'));
    }

    public function detail_book_major_page($id) {
        $major = BookMajor::withTrashed()->with('created_by:usr_id,name', 'updated_by:usr_id,name', 'deleted_by:usr_id,name')->find($id);
        return view('book.major.detail', ['title' => 'Halaman Detail Jurusan'], compact('major'));
    }

    public function add_book_major_page() {
        return view('book.major.add', ['title' => 'Halaman Tambah Jurusan']);
    }

    public function add_book_major_system(Request $request) {
        $validateData = $request->validate([
            'bk_mjr_class' => 'required | regex:/^[0-9]+$/ | max:255',
            'bk_mjr_major' => 'required | string | max:255'
        ]);

        BookMajor::create($validateData);
        return redirect('/manage/book/major')->with('success', 'Jurusan Berhail Ditambahkan');
    }

    public function edit_book_major_page($id) {
        return view('book.major.edit', ['title' => 'Halaman Ubah Jurusan']);
    }

    public function edit_book_major_system(Request $request, $id) {
        $major = BookMajor::find($id);
        $validateData = $request->validate([
            'bk_mjr_class' => 'sometimes | required | regex:/^[0-9]+$/ | max:255',
            'bk_mjr_major' => 'sometimes | required | string | max:255'
        ]);

        $major->update($validateData);
        return redirect('/manage/book/major')->with('success', 'Jurusan Berhail Diubah');
    }

    public function delete_book_major_system($id) {
        BookMajor::find($id)->delete();
        return redirect('/manage/book/major')->with('success', 'Jurusan Berhail Dihapus');
    }

    public function manage_book_author_page() {
        $authors = Author::select('athr_id', 'athr_name')->latest()->paginate(10);
        return view('book.author.view', ['title' => 'Halaman Kelola Penulis'], compact('authors'));
    }

    public function detail_book_author_page($id) {
        $author = Author::withTrashed()->with('created_by:usr_id,name', 'updated_by:usr_id,name', 'deleted_by:usr_id,name')->find($id);
        return view('book.author.detail', ['title' => 'Halaman Kelola Penulis'], compact('author'));
    }

    public function add_book_author_page() {
        return view('book.author.add', ['title' => 'Halaman Tambha Penulis']);
    }

    public function add_book_author_system(Request $request) {
        $validateData = $request->validate([
            'athr_name' => 'required | string | max:255'
        ]);

        Author::create($validateData);
        return redirect('/manage/book/author')->with("success", "Penulis Berhasil Ditambahkan");
    }

    public function edit_book_author_page($id) {
        $authors = Author::select('athr_id', 'athr_name')->find($id);
        return view('book.author.edit', ['title' => 'Halaman Ubah Penulis'], compact('authors'));
    }

    public function edit_book_author_system(Request $request, $id) {
        $author = Author::find($id);

        $validateData = $request->validate([
            'athr_name' => 'sometimes | required | string | max:255'
        ]);

        $author->update($validateData);
        return redirect('/manage/book/author')->with("success", "Penulis Berhasil Diubah");
    }

    public function delete_book_author_system(Request $request, $id) {
        $author = Author::find($id);

        $author->delete();
        return redirect('/manage/book/author')->with("success", "Penulis Berhasil Dihapus");
    }

    public function manage_book_publisher_page() {
        $publishers = Publisher::select('pub_id', 'pub_name', 'pub_address')->latest()->paginate(10);
        return view('book.publisher.view', ['title' => 'Halaman Kelola Penerbit'], compact('publishers'));
    }

    public function detail_book_publisher_page($id) {
        $publisher = Publisher::with('created_by', 'updated_by', 'deleted_by')->withTrashed()->find($id);
        return view('book.publisher.detail', ['title' => 'Halaman Detail Penerbit'], compact('publisher'));
    }

    public function add_book_publisher_page() {
        return view('book.publisher.add', ['title' => 'Halaman Tambah Penerbit']);
    }

    public function add_book_publisher_system(Request $request) {
        $validateData = $request->validate([
            'pub_name' => 'required | string | max:255',
            'pub_address' => 'required | string | max:255',
        ]);

        Publisher::create($validateData);
        return redirect('/manage/book/publisher')->with('success', 'Penerbit Berhasil Ditambahkan');
    }

    public function edit_book_publisher_page($id) {
        $publishers = Publisher::select('pub_id', 'pub_name', 'pub_address')->find($id);
        return view('book.publisher.edit', ['title' => 'Halaman Ubah Penerbit'], compact('publishers'));
    }

    public function edit_book_publisher_system(Request $request, $id) {
        $publisher = Publisher::find($id);

        $validateData = $request->validate([
            'pub_name' => 'sometimes | required | string | max:255',
            'pub_address' => 'sometimes | required | string | max:255',
        ]);

        $publisher->update($validateData);
        return redirect('/manage/book/publisher')->with('success', 'Penerbit Berhasil Diubah');
    }

        public function delete_book_publisher_system(Request $request, $id) {
        $author = Publisher::find($id);

        $author->delete();
        return redirect('/manage/book/publisher')->with("success", "Penerbit Berhasil Dihapus");
    }

    public function manage_book_classfication_page() {
        $classfications = DeweyDecimalClassfication::select('ddc_id', 'ddc_code', 'ddc_description')->latest()->paginate(10);
        return view('book.classfication.view', ['title' => 'Halaman Kelola Klasifikasi'], compact('classfications'));
    }

    public function detail_book_classfication_page($id) {
        $classfication = DeweyDecimalClassfication::withTrashed()->with('created_by', 'updated_by', 'deleted_by')->find($id);
        return view('book.classfication.detail', ['title' => 'Halaman Ubah Klasifikasi'], compact('classfication'));
    }

    public function add_book_classfication_page() {
        return view('book.classfication.add', ['title' => 'Halaman Tambah Klasifikasi']);
    }

    public function add_book_classfication_system(Request $request) {
        $validateData = $request->validate([
            'ddc_code' => 'required | regex:/^[0-9]+$/ | max:255',
            'ddc_description' => 'required | string | max:255',
        ]);

        DeweyDecimalClassfication::create($validateData);
        return redirect('/manage/book/ddc')->with('success', 'Klasifikasi Berhasil Ditambahkan');
    }

    public function edit_book_classfication_page($id) {
        $classfications = DeweyDecimalClassfication::select('ddc_id', 'ddc_code', 'ddc_description')->find($id);
        return view('book.classfication.edit', ['title' => 'Halaman Ubah Klasifikasi'], compact('classfications'));
    }

    public function edit_book_classfication_system(Request $request, $id) {
        $classfication = DeweyDecimalClassfication::find($id);

        $validateData = $request->validate([
            'ddc_code' => 'sometimes | required | regex:/^[0-9]+$/ | max:255',
            'ddc_description' => 'sometimes | required | string | max:255',
        ]);

        $classfication->update($validateData);
        return redirect('/manage/book/ddc')->with('success', 'Klasifikasi Berhasil Diubah');
    }

    public function delete_book_classfication_system(Request $request, $id) {
        $classfication = DeweyDecimalClassfication::find($id);

        $classfication->delete();
        return redirect('/manage/book/ddc')->with('success', 'Klasifikasi Berhasil Dihapus');
    }
}
