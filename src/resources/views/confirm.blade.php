@extends('layouts.app')

@section('title')
confirm
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
    Confirm
    </div>
      <form class="form" action="/contact" method="post">
      @csrf
        <div class="confirm-table">
          <table class="confirm-table__inner">
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
              <td class="confirm-table__text">
                <input type="text" value="{{ $contact['last_name'].'　'. $contact['first_name'] }}" readonly />
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">性別</th>
              <td class="confirm-table__text">
                @if ($contact['gender']==='1')
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />
                男性
                @elseif ($contact['gender']==='2')
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />女性
                @else
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />その他
                @endif
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
              <td class="confirm-table__text">
                <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">電話番号</th>
              <td class="confirm-table__text">
                <input type="tel" name="tel" value="{{ $contact['tel1'].$contact['tel2'].$contact['tel3'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">住所</th>
              <td class="confirm-table__text">
                <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">建物名</th>
              <td class="confirm-table__text">
                <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせの種類</th>
              <td class="confirm-table__text">
                @if ($contact['category_id']==='1')
                <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />商品のお届けについて
                @elseif ($contact['category_id']==='2')
                <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />商品の交換について
                @elseif ($contact['category_id']==='3')
                <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />商品トラブル
                @elseif ($contact['category_id']==='4')
                <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />ショップへのお問い合わせ
                @else
                <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />その他
                @endif
              </td>
            </tr>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
              <td class="confirm-table__text">
                <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
              </td>
            </tr>
          </table>
        </div>
        <div class="form__button">
        <div class="form__submit">
          <button class="form__button-submit" type="submit">送信</button>
        </div>
        <div class="form__update">
          <button class="form__button-update" type="button" onClick="history.back()">修正</button>
        </div>
        </div>
      </form>
@endsection