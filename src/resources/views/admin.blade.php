@extends('layouts.app')

@section('title')
contact
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
@endsection


@section('header-button')
@if (Auth::check())
<form class="logout__button" action="/logout" method="post">
@csrf
<button class="logout__button-submit">logout</button>
</form>
@endif
@endsection


@section('content')
<div class="search-form__content">
    <div class="search-form__heading">
    Admin
    </div>
    <form class="search-form" action="/contacts/search" method="get">
    @csrf
    <div class="search-form__item">
    <input class="search-form__item" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください">
    </div>
    <select class="search-form__gender" name="gender">
        <option value="">性別</option>
        <option value="">すべて</option>
        <option value="1">男性</option>
        <option value="2">女性</option>
        <option value="3">その他</option>
    </select>
    <select class="search-form__type" name="category_id">
        <option value="">お問い合わせの種類</option>
        @foreach ($categories as $category)
        <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
        @endforeach
    </select>
    <input class="search-form__date" type="date" name="created_at" value="">
    <div class="search-form__button">
        <button class="search-form__button-submit" type="submit">検索</button>
    </div>
    <div class="search-form__resetbutton">
        <a href="/admin" class="search-form__resetbutton-submit">リセット</a>
    </div>
    </form>
</div>

<div class="export-form">
    <form class="export-form_button" action="/csv/download" method="POST">
    @csrf
    <div class="export-form__button">
        <button class="export-form__button-submit" type="">エクスポート</button>
    </div>
    </form>
    <div>
    {{$contacts->links('pagination::bootstrap-4')}}
    </div>
</div>

<div class="contact-table">
    <table class="contact-table__inner">
        <tr class="contact-table__header">
            <th class="contact-table__inner-th">お名前</th>
            <th class="contact-table__inner-th">性別</th>
            <th class="contact-table__inner-th">メールアドレス</th>
            <th class="contact-table__inner-th">お問い合わせの種類</th>
            <th class="contact-table__inner-th"></th>
        </tr>
        @foreach ($contacts as $contact)
        <tr class="contact-table__row">
            <td class="contact-table__inner-td">{{$contact->last_name}}　{{$contact->first_name}}<input type="hidden" name="id" value="{{$contact->id}}">
            </td>
            @if ($contact->gender===1)
            <td class="contact-table__inner-td">男性</td>
            @elseif ($contact->gender===2)
            <td class="contact-table__inner-td">女性</td>
            @else
            <td class="contact-table__inner-td">その他</td>                
            @endif
            <td class="contact-table__inner-td">{{$contact->email}}</td>
            <td class="contact-table__inner-td-category">{{$contact->category->content}}</td>
            <td class="contact-table__detail">
            <div class="contact-table__detail-button">
                <a href="#modal" class="contact-table__detail-button-submit">詳細</a>
            <div class="modal" id="modal">
            <div class="modal-wrapper">
                <a href="#" class="close">&times;</a>
            <div class="modal-content">
            <form class="delete-form" action="/contacts/delete" method="post">
            @method('DELETE')
            @csrf
            <table class="detail-table__inner">
            <tr class="detail-table__row">
              <th class="detail-table__header">お名前</th>
              <td class="detail-table__text">
                <input type="hidden" name="id" value="{{$contact->id}}">
                <input type="text" value="{{ $contact['last_name'].'　'. $contact['first_name'] }}" readonly />
              </td>
            </tr>
            <tr class="detail-table__row">
              <th class="detail-table__header">性別</th>
              <td class="detail-table__text">
                @if ($contact->gender===1)
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />
                男性
                @elseif ($contact->gender===2)
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />女性
                @else
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />その他
                @endif
              </td>
            </tr>
            <tr class="detail-table__row">
              <th class="detail-table__header">メールアドレス</th>
              <td class="detail-table__text">
                <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
              </td>
            </tr>
            <tr class="detail-table__row">
              <th class="detail-table__header">電話番号</th>
              <td class="detail-table__text">
                <input type="tel" name="tel" value="{{ $contact['tel'] }}" readonly />
              </td>
            </tr>
            <tr class="detail-table__row">
              <th class="detail-table__header">住所</th>
              <td class="detail-table__text">
                <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
              </td>
            </tr>
            <tr class="detail-table__row">
              <th class="detail-table__header">建物名</th>
              <td class="detail-table__text">
                <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
              </td>
            </tr>
            <tr class="detail-table__row">
              <th class="detail-table__header">お問い合わせの種類</th>
              <td class="detail-table__text">
                @if ($contact->category_id===1)
                <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />商品のお届けについて
                @elseif ($contact->category_id===2)
                <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />商品の交換について
                @elseif ($contact->category_id===3)
                <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />商品トラブル
                @elseif ($contact->category_id===4)
                <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />ショップへのお問い合わせ
                @else
                <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />その他
                @endif
              </td>
            </tr>
            <tr class="detail-table__row">
              <th class="detail-table__header">お問い合わせ内容</th>
              <td class="detail-table__text">
                <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
              </td>
            </tr>
            </table>
            <div class="delete-form__button">
              <button class="delete-form__button-submit" type="submit">削除</button>
            </div>
            </form>
            </div>
            </div>
            </div>
            </div>
            </td>
        </tr>
        @endforeach        
    </table>
</div>

@endsection