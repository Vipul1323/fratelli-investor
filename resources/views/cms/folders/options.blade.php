<div class="col-lg-4">
    {!! Form::label('parent', 'Parent Folder') !!}
    {!! Form::select('parent', $folders, "", ['class' => 'form-control','onchange' => 'loadCategory(this)', 'parentId' => $parentId, 'id' => 'folder_'.$parentId,'placeholder' => 'Select Folder' ]) !!}
</div>
