@extends('frontend.master-frontend')

@section('js-css')
<style type="text/css">
    .upgradeBTN{
        width: 100%;
        border: none;
        border-radius: 2px;
        padding: 10px;
        }
 </style>
@endsection

@section('content')
<br>


    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Account Reset</p>
            </div>
        </div>
        <div class="container">
            <h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px">
                Reset My Account
            </h2>

            <p class="text-center">
                When you have completed a section you may reset it at any time. This means ‘clearing the decks’ and you can then retry the courses. With PrepareMedicine you can reset any number of times during your subscription period’
            </p>
        </div>

        <div class="row my-4 my-md-5 justify-content-center" style="padding-left: 45px; padding-right: 45px">
            <div class="col-md-3"></div>
            <div class="col-md-6 mb-2">
                <a href="{{ url('account/account-reset/all') }}" class="btn btn-spinner reset-account col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden;background-color: #2C3069">
                    <img src="{{ url('storage/account/reset-gear.png') }}" alt="" style="width:35%;float:left;height:55px;">
                    <span style="margin-top:17px">RESET MY ACCOUNT</span>
                </a>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>


    @if(session()->has('error'))
        <!-- Modal -->
        <div class="modal fade show" data-backdrop="static" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" style="display: block; padding-right: 17px;">
          <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
              <div class="modal-header" style="background: red">
                <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
                <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">
                <h5 style="color: red">{{ session()->get('error') }}</h5>
                <br>
                <a href="{{ route('root_page') }}#most_popular_courses" class="upgradeBTN btn btn-success btn-sm">Upgrade Plan</a>
              </div>
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>

        <script>
            document.getElementById("closeModal").addEventListener("click", function(){
                let modalX = document.getElementById("exampleModalCenter");

                modalX.classList.remove("show");
                modalX.style.display = 'none';
            });
        </script>
    @endif

<br>

@endsection
