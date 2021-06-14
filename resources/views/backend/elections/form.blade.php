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
      <label for="start_date">
        Tanggal Mulai
        <span class="text-danger">*</span>
      </label>
      <div class="input-group datetimepicker" id="start_date" data-target-input="nearest">
        <input value="{{ old('start_date',  $election->start_date->format('d-m-Y H:m:s') ?? '') }}" type="text" class="form-control datetimepicker-input" required data-target="#start_date" name="start_date" placeholder="dd-mm-yyyy" />
        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
      @error('start_date')
        <div class="invalid-feedback d-block">{{$message}}</div>
      @enderror
    </div>
  </div>
  <div class="col-12">
    <div class="form-group">
      <label for="end_date">
        Tanggal Selesai
        <span class="text-danger">*</span>
      </label>
      <div class="input-group datetimepicker" id="end_date" data-target-input="nearest">
        <input value="{{ old('end_date', $election->end_date->format('d-m-Y H:m:s') ?? '') }}" type="text" class="form-control datetimepicker-input" required data-target="#end_date" name="end_date" placeholder="dd-mm-yyyy" />
        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
      @error('end_date')
        <div class="invalid-feedback d-block">{{$message}}</div>
      @enderror
    </div>
  </div>
</div>