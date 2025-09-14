<?php

namespace App\Http\Controllers;

use App\Models\Author;
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

    public function manage_book_author_page() {
        return view('book.author.view', ['title' => 'Halaman Kelola Penulis']);
    }

    public function detail_book_author_page($id) {
        return view('book.author.detail', ['title' => 'Halaman Detail Penulis']);
    }

    public function add_book_author_page() {
        return view('book.author.add', ['title' => 'Halaman Tambha Penulis']);
    }

    public function add_book_author_system(Request $request) {
        $validateData = $request->validate([
            'athr_name' => 'required | string | max:255'
        ]);

        Author::create($validateData);
        return redirect('/manage/book/author')->with("success", "Buku Berhasil Ditambahkan");
    }

    public function edit_book_author_page($id) {
        return view('book.author.edit', ['title' => 'Halaman Ubah Penulis']);
    }

    public function edit_book_author_system(Request $request, $id) {
        $author = Author::find($id);

        $validateData = $request->validate([
            'athr_name' => 'sometimes | required | string | max:255'
        ]);

        $author->update($validateData);
        return redirect('/manage/book/author')->with("success", "Buku Berhasil Diubah");
    }

    public function manage_book_publisher_page() {
        return view('book.publisher.view', ['title' => 'Halaman Kelola Penerbit']);
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
        return view('book.publisher.edit', ['title' => 'Halaman Ubah Penerbit']);
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

    public function manage_book_classfication_page() {
        return view('book.classfication.view', ['title' => 'Halaman Kelola Klasifikasi']);
    }

    public function add_book_classfication_page() {
        return view('book.classfication.add', ['title' => 'Halaman Tambah Klasifikasi']);
    }

    public function add_book_classfication_system(Request $request) {
        $validateData = $request->validate([
            'ddc_code' => 'required | string | max:255',
            'ddc_description' => 'required | string | max:255',
        ]);

        DeweyDecimalClassfication::create($validateData);
        return redirect('/manage/book/ddc')->with('success', 'Klasifikasi Berhasil Ditambahkan');
    }

    public function edit_book_classfication_page($id) {
        return view('book.classfication.edit', ['title' => 'Halaman Ubah Klasifikasi']);
    }

    public function edit_book_classfication_system(Request $request, $id) {
        $classfication = DeweyDecimalClassfication::find($id);

        $validateData = $request->validate([
            'ddc_code' => 'sometimes | required | string | max:255',
            'ddc_description' => 'sometimes | required | string | max:255',
        ]);

        $classfication->update($validateData);
        return redirect('/manage/book/ddc')->with('success', 'Klasifikasi Berhasil Diubah');
    }
}
