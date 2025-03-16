<x-mail::message>
# Introduction

تم إنشاء طلب جديد برقم {{ $order->id }}

<x-mail::button :url="$url">
عرض الطلب
</x-mail::button>

شكراً,<br>
{{ config('app.name') }}
</x-mail::message>
