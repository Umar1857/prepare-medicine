@extends('frontend.master-frontend')
@section('js-css')
<style type="text/css">
    .btn-spinner:hover{
        background: #666 !important;
        color: #fff !important;
    }
</style>
@endsection

@section('content')
<br>


{{--  data fetch from Database !!  --}}

    <div class="container-fluid">
        
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Facebook Groups</p>
            </div>
        </div>

        <div class="container">
            <h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px">
                    Facebook Groups
                </h2>
                
                <p class="text-center">
                    In order to join one of the peer support groups, please log onto our site from your mobile phone (which must already have WhatsApp installed). You can then automatically join one of the groups by clicking on the Icon. These groups are a peer support forum for discussing questions with each other and sharing your experiences of your PLAB 1 & 2 journey. We expect you to use the groups with respect, as outlined in our terms and conditions section, and we hope as well as sharing tips on answering questions and what to expect in the PLAB exams that you are all able to enjoy some gen-eral banter – as long as it is focused on PrepareMedicine and PLAB. Our admins do have access to the groups purely for monitoring any snags with the service. If anybody has any problems using the group then please contact us using out Contact Us link
                    The WhatsApp groups adhere to the terms and conditions of service including not copying material or breaching copyright in general. In addition, you are not permitted to use the groups for any political or other purpose especially where it may cause offense’
 
                </p>
        </div>

        <div class="row my-4 my-md-5" style="padding-left: 45px; padding-right: 45px">
            @foreach ($data as $key=>$item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                    <a href="{!! $item->link !!}" class="btn btn-spinner col-12 p-0" style="background:#2C3069;padding:0;border-radius:10px;overflow:hidden">
                        <img src="{{ url('storage/community-groups/'.$item->cat_img) }}" alt="" style="width:35%;float:left;height:55px;">
                        <span style="margin-top:17px">{{ $item->name }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>



<br>
@endsection

@section('js')

@endsection