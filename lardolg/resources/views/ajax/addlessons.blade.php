<tr data-num="{{$request->temp['num']}}">
    <td>{{$request->temp['num']}}</td>
    <td>{{$lesson->name}}</td>
    <td>
        <select data-set="{{$lessonteacher}}" name="lessonteacher" id="addlessonteacher">
            <option value="">-- Учитель предметник --</option>
            @foreach($teachers as $teacher)
                <option  value="{{$teacher->id}}">{{$teacher->name}}</option>
            @endforeach
        </select>
    </td>
    <td></td>
</tr>