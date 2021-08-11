<!-- Second stage of the form (Selection of evaluation criteria according to category 1) -->

<div class="col">
    <ul class="list-group"  id="listGroup">
        <!-- These data are obtained from the database of the indicators entity, based on category 1 -->
        @foreach($indicators as $item)
        @if( $item['idCategory'] == 1 )

        <!-- Edit option, it is verified if the controller returns a list of indicator id -->
        <?php 
            if( isset($details) ) { 
                // Find a match between the id of the general list of indicators, 
                // with the array of id stored in the evaluation detail
                $found = array_search($item->id, array_column($details, 'idIndicator'));
            }
        ?>

        <li class="list-group-item element">
            <div class="row">
                <div class="col-10">
                    <label style="padding-top: 7px;">{{ $item['description'] }}</label>
                </div>
                <!-- Checkbox suitch -->
                <div class="col-2">
                    <label class="switch">
                        <!-- verification when editing, if the element is true, enable the check -->
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