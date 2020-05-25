

<label for="testRender">Тест</label>
<select id="testRender" onchange="if(this.value =='href') document.location.href='make_tests';"  name="pass-test" class="passtest">
    <option value="">
        Тест для исправления ошибок
    </option>
    @if(isset($tests))
    @foreach ($tests as $test)
        <option value="{{$test->id}}">Тест: {{$test->name}} Автор: {{$name[$test->id]->name}}</option>
    @endforeach
@endif
<option value="href">
    ---Создать тест---
    </option>
</select>
<label for="materialRender">Учебный материал</label>
<select id="materialRender" onchange="if(this.value =='href') document.location.href='make_tests';"  name="pass-material" class="passtest">
    <option value="">
        Материал для изучения
    </option>
    @if(isset($materials))
    @foreach ($materials as $material)
        <option value="{{$material->id}}">Название: {{$material->name}} Автор: {{$names[$material->id]->name}}</option>
    @endforeach
@endif
<option value="href">
    ---Добавить учебный материал---
    </option>
</select>