        <div class="columns small-7 ctr-add">
            {{ Form::open(array('route' => 'names.add', 'id' => 'form-name-add')) }}
            <div class="row postfix-radius">
                <div class="columns small-12">
                    {{ Form::button('Add Name', array('id' => 'button-name-add', 'class' => 'button tiny radius')) }}
                    {{ Form::text('field-name-add', null, array('id' => 'field-name-add', 'class' => 'text-center', 'placeholder' => 'Start typing a new name to add here')) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>