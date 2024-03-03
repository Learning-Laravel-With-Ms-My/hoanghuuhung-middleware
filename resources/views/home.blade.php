<h1>Trang chủ Unicode</h1>
<h2>{{!empty(request()->keyword)?request()->keyword:'Không có gì'}}</h2>
<div class="container">
    {!! !empty($content)?$content: false !!}
</div>
<hr>
@for($i = 0; $i < 10; $i++)
    <p>Phần tử thứ: {{$i}}</p>
@endfor
<hr>
@while($index<=10)
    <p>Vòng lặp while: Phần tử thứ: {{$index}}</p>
    @php
        $index++
    @endphp
@endwhile
<hr>
@foreach($dataArr as $key => $item)
    <p>Vòng lặp foreach: Phần tử: {{$item}} với key là: {{$key}}</p>
@endforeach
<hr>
@forelse($dataArr as $key => $item)
    <p>Vòng lặp forelse: Phần tử: {{$item}} với key là: {{$key}}</p>
@empty
    <p>Không có phần tử nào</p>
@endforelse
<hr>
@if ($number>= 10)
    <p>Đây là giá trị hợp lệ</p>    
@else
    <p>Giá trị không hợp lệ</p>
@endif
<hr>
@if ($number < 0)
    <p>Số âm</p>
@elseif ($number >= 0 && $number < 5)
    <p>Số siêu nhỏ</p>
@elseif ($number > 5 && $number < 10)
    <p>Số trung bình</p>
@else
    <p>Số lớn </p>
@endif
<hr>
@switch($number)
    @case(2)
    @case(4)
    @case(5)
        <p>Đây là số thứ nhất</p>
        @break
    @default
        <p>Đây là số nguyên</p>

@endswitch

<hr>
@for($i = 0; $i < 10; $i++)
    <p>Phần tử thứ: {{$i}}</p>
    @if($i == 5)
        @break
    @endif
@endfor
<hr>
@for($i = 0; $i < 10; $i++)
    @if($i == 5)
        @continue
    @endif
    <p>Phần tử thứ: {{$i}}</p>
@endfor