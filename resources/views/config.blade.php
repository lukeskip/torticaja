@extends('layouts.app')
@section('content')

<form action="" class="config-sheet">
    <div class="boolean" data-label="Gas" data-id="gas" data-init="1"></div>
    <div class="boolean" data-label="Kilo por peso" data-id="kg-peso" data-init="0"></div>
    <div class="boolean" data-label="Esto es otro boton y es más larga la descripción" data-id="larga" data-init="0"></div>
    <div class="form-group">
        <label for="">Precio Harina</label>
        <input type="text">
    </div>
    
</form>


@endsection

