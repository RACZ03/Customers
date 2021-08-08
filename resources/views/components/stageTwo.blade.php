

<div class="col">
    <ul class="list-group">
        @foreach($indicators as $item)
        @if( $item['idCategory'] == 1 )

        <li class="list-group-item">
            <div class="row">
                <div class="col-10">
                    <label style="padding-top: 7px;">{{ $item['description'] }}</label>
                </div>
                <div class="col-2">
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </li>
        @endif
        @endforeach
    </ul>
</div>