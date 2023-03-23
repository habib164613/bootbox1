


<form id="createStudentForm"  action="" method="post" autocomplete="off" >
  @csrf
  @method('POST')

  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="name" class="form-control" id="name" name="name" >
    <div class="nameError   errors d-none"></div>
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control" id="email" name="email" >
    <div class="emailError   errors d-none"></div>
  </div>

  <div class="mb-3">
    <label for="photo" class="form-label">Photo</label>
    <input type="file" class="form-control" id="photo" name="photo" >
    <div class="photoError   errors d-none"></div>
  </div>

  
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1 " name="accepeted">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
    <div class="accepetedError   errors d-none"></div>
  </div>

  <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
  <div class="button mt-4 text-end">
    <button type="button" class="btn btn-danger me-3  bootbox-close-button">Cansel</button>
    <!-- bootbox-accept -->
    <button type="submit" class="btn btn-primary me-3"   >Save</button>
    
  </div>
</form>
