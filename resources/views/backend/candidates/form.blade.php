<div class="row">
  <div class="col-12">
    <div class="form-group">
      <?php
      $field_name = 'name';
      $field_label = 'Nama';
      $field_placeholder = $field_label;
      $required = "required";
      ?>
      {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
      {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
      @error('name')
        <div class="invalid-feedback d-block">{{$message}}</div>
      @enderror
    </div>
  </div>
  <div class="col-12">
    <div class="form-group">
      <?php
      $field_name = 'description';
      $field_label = 'Deskripsi';
      $field_placeholder = $field_label;
      $required = "";
      ?>
      {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
      {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
      @error('description')
        <div class="invalid-feedback d-block">{{$message}}</div>
      @enderror
    </div>
  </div>
  <div class="col-12">
    <div class="form-group">
      <?php
      $field_name = 'profile_image';
      $field_label = 'Foto';
      $field_placeholder = $field_label;
      $required = "required";
      ?>
      {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
      {{ html()->file($field_name)->class('form-control')->attributes(["$required"]) }}
      @error('profile_image')
        <div class="invalid-feedback d-block">{{$message}}</div>
      @enderror
    </div>
  </div>
  <div class="col-12 mb-4">
    @if (isset($candidate))
      <img src="{{asset($candidate->profile_image)}}" alt="Foto kandidat {{$candidate->name}}" class="img-fluid img-thumbnail" style="height: 20rem;">
    @endif
  </div>
</div>