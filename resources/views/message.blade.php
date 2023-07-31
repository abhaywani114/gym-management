@extends('layout')

@section('content')

<div class="regular-content">
    <div class="d-flex login-wrapper">
        <div class=" message">
            @if($msg['success'] == true)
              <div class="icon icon--order-success svg" style="margin-bottom: 30px;">
                   <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                    <g fill="none" stroke="#8EC343" stroke-width="2">
                       <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                       <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                    </g>
                   </svg>
               </div>
            @else
              <div class="icon icon--order-success svg" style="margin-bottom: 15px;">
                <svg width="120" height="120" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M36 0C55.8792 0 72 16.1208 72 36C72 55.8792 55.8792 72 36 72C16.1208 72 0 55.8792 0 36C0 16.1208 16.1208 0 36 0ZM36 7.2C20.1204 7.2 7.2 20.1204 7.2 36C7.2 51.8796 20.1204 64.8 36 64.8C51.8796 64.8 64.8 51.8796 64.8 36C64.8 20.1204 51.8796 7.2 36 7.2ZM44.2548 22.6548L49.3452 27.7452L41.0904 36L49.3452 44.2548L44.2548 49.3452L36 41.0904L27.7452 49.3452L22.6548 44.2548L30.9096 36L22.6548 27.7452L27.7452 22.6548L36 30.9096L44.2548 22.6548Z" fill="#FF0000" fill-opacity="0.74"/>
              </svg>
            </div>

            @endif
          <h4 @if($msg['success'] == false) style="color: red" @endif><span style="text-align: center;display: block;">{{$msg['msg']}}</span></h4>
        @if($msg['success'] == true)
        @if (isset($msg['button']))
         <div class="form" style="flex:0">
           <div class="button-wrapper">
                <button class="button" style="flex-grow:0;" onclick="window.history.back()">Back</button>
              </div>
        </div>
        @endif
        @endif
      </div>

  </div>
</div>
@endsection
