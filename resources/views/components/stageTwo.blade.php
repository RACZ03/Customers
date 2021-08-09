

<div class="col">
    <ul class="list-group"  id="listGroup">
        @foreach($indicators as $item)
        @if( $item['idCategory'] == 1 )
        <?php if($details->contains('idEvaluation', $item->id)){echo'hi';}else{echo'no';} ?>

        <li class="list-group-item element">
            <div class="row">
                <div class="col-10">
                    <label style="padding-top: 7px;">{{ $item['description'] }}</label>
                </div>
                <div class="col-2">
                    <label class="switch">
                        <input type="checkbox" 
                               checked="{{ isset($details) ? $details->contains('idEvaluation', $item->id) : false}}"
                               class="item_selected" 
                               id="{{ $item['id'] }}">
                        <span class="slider round"></span>

                    </label>
                </div>
            </div>
        </li>

       
        @endif
        @endforeach
    </ul>
</div>