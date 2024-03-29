<section class="" >
  <div class="container ">
    <div class="row d-flex justify-content-center align-items-center ">
      <div class="col col-md-9 col-lg-7 col-xl-12">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="d-flex text-black">
              <div class="flex-shrink-0">
                
                <img src="{{asset('uploads/student-img/'.$student->photo)}}"
                  alt="Generic placeholder image" class="img-fluid "
                  style="width: 180px; border-radius: 10px;">
              </div>
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1">{{$student->name}}</h5>
                <p class="mb-2 pb-1" style="color: #2b2a2a;">{{$student->email}}</p>
                <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                  style="background-color: #efefef;">
                  <div>
                    <p class="small text-muted mb-1">Articles</p>
                    <p class="mb-0">41</p>
                  </div>
                  <div class="px-3">
                    <p class="small text-muted mb-1">Followers</p>
                    <p class="mb-0">976</p>
                  </div>
                  <div>
                    <p class="small text-muted mb-1">Rating</p>
                    <p class="mb-0">8.5</p>
                  </div>
                </div>
                <div class="d-flex pt-1">
                  <button type="button" class="btn btn-outline-danger bootbox-close-button me-1 flex-grow-1">Cansel</button>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>