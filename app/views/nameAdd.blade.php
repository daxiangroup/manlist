        <div class="columns small-7 ctr-add">
            {{ Form::open(array('route' => 'name.add', 'id' => 'form-name-add')) }}
            <div class="row">
                <div class="columns small-12">
                    {{ Form::button('Add Name', array('id' => 'button-name-add', 'class' => 'button tiny radius')) }}
                    {{ Form::text('new-name', null, array('id' => 'field-name-add', 'class' => 'radius text-center', 'placeholder' => 'Add a new name here')) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>