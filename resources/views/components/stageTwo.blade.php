

<div class="col">
    <ul class="list-group"  id="listGroup">
        @foreach($indicators as $item)
        @if( $item['idCategory'] == 1 )

        <?php 
            if( isset($details) ) { 
                $found = array_search($item->id, array_column($details, 'idIndicator'));
            }
        ?>

        <li class="list-group-item element">
            <div class="row">
                <div class="col-10">
                    <label style="padding-top: 7px;">{{ $item['description'] }}</label>
                </div>
                <div class="col-2">
                    <label class="switch">
                        @if( isset($found) && $found !== false )
                        <input type="checkbox" class="item_selected" id="{{ $item['id'] }}" checked>
                        @else
                        <input type="checkbox" class="item_selected" id="{{ $item['id'] }}">
                        @endif
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </li>

       
        @endif
        @endforeach
    </ul>
</div>