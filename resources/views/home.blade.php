@extends('layouts.app')
@section('header-style')
<style>

    .container {
        margin: 0 auto !important;
        width: 750px !important;
        /* background: #444753 !important; */
        border-radius: 5px !important;
    }
    .clearfix {
        display: flex;
    }

    .people-list {
        width:260px;
        float: left;
        background: rgb(212, 228, 216) !important; 
        height: 100%;
        overflow-y: auto;
        margin-bottom: 2rem;
    }
    .search {
        padding: 20px;
    }
    input {
        border-radius: 3px;
        border: none;
        padding: 14px;
        color: white;
        background: #6A6C75;
        /* width: 100%; */
        font-size: 14px;
    }

    .fa-search {
        position: relative;
        left: -25px;
    }
    ul {
        padding: 20px;
        height: 770px;
    }
    li {
        padding-bottom: 20px;
    }

    img {
        float: left;
    }

    .about {
        float: left;
        margin-top: 8px;
    }
    
    .about {
        padding-left: 8px;
        cursor: pointer;
    }
    
    .status {
        color: #92959E;
    }
    
    .chat {
        width: 490px;
        float:left;
        background: #F2F5F8;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        color: #434651;
    }

    .chat-header {
        padding: 20px;
        border-bottom: 2px solid white;
    }

    .chat-header img {
        float: left;
    }
    .chat-about {
        float: left;
        padding-left: 10px;
        margin-top: 6px;
    }
    
    .chat-with {
        font-weight: bold;
        font-size: 16px;
    }
    
    .chat-num-messages {
        color: rgb(151, 149, 149);
    }
    
    .fa-star {
        float: right;
        color: #D8DADF;
        font-size: 20px;
        margin-top: 12px;
    }

    .chat-history {
        padding: 30px 30px 20px;
        border-bottom: 2px solid white;
        overflow-y: scroll;
        height: 575px;
    }
    .message-data {
        margin-bottom: 15px;
    }
    
    .message-data-time {
        color: lighten($gray, 8%);
        padding-left: 6px;
    }

    .message {      
        color: white;
        padding: 18px 20px;
        line-height: 26px;
        font-size: 16px;
        border-radius: 7px;
        margin-bottom: 30px;
        width: 90%;
        position: relative;
    }

    .message:after {
        bottom: 100%;
        left: 7%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #86BB71;
        border-width: 10px;
        margin-left: -10px;
    }

    .my-message {
        background: #86BB71;
    }

    .my-message:after {
        border-bottom-color:#86BB71;
        left: 10%;
    }

    .other-message {
        background: #94C2ED ;
        }
    .other-message:after {
        border-bottom-color:#94C2ED;
        left: 93%;
    }

    .chat-message {
        padding: 30px;
    }

    textarea {
        width: 100%;
        border: none;
        padding: 10px 20px;
        font: 14px/22px "Lato", Arial, sans-serif;
        margin-bottom: 10px;
        border-radius: 5px;
        resize: none;
    
    }

    .fa-file-o, .fa-file-image-o {
        font-size: 16px;
        color: gray;
        cursor: pointer;
    
    }

    button {
        float: right;
        color: #94C2ED;
        font-size: 16px;
        text-transform: uppercase;
        border: none;
        cursor: pointer;
        font-weight: bold;
        background: #F2F5F8;
    
   
    }

    button:hover {
        color: darken(#94C2ED, 7%);
    }

    .message-data span li.online, .offline, .me {
        margin-right: 3px;
        font-size: 10px !important;
        display: block;
    }

    .online {
        color: #86BB71;
    }

    .offline {
        color: #E38968;
    }

    .me {
        color: #94C2ED ;           
    }

    .align-left {
        text-align: left;
    }

    .align-right {
        text-align: right;
    }

    .float-right {
        float: right;
    }

    .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }

    ul li {
        list-style: none;
    }

    .text-success {
        color: green;
    }

</style>
@endsection

@section('content')
<div class="py-5 px-5">
    <form action="{{ route('logout') }}" method="POST" >
        @csrf
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
</div>
<div id="app" class="container-fluid" >
    <main-app></main-app>
</div>


@endsection
