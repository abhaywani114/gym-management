@extends('layout')
@section('title', 'Web Feed')

@section('content')
<div class="webfeed-wrapper">
<div class="timeline-wrapper webfeed">
    <div class="timeline-line"></div>
    <div class="post">
        <div class="icon">
            <div class="svgicon">
<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.7 4C18.87 4 21 6.98 21 9.76C21 15.39 12.16 20 12 20C11.84 20 3 15.39 3 9.76C3 6.98 5.13 4 8.3 4C10.12 4 11.31 4.91 12 5.71C12.69 4.91 13.88 4 15.7 4Z" stroke="#06607f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>
        </div>
        <div class="search-result">
            <div class="image">
                <img src="https://placehold.co/600x400" />
            </div>
            <div class="text form">
                <h1 class="username">Abrar Ajaz</h1>
                <p class="description">On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble.</p>
                <div class="buttons button-wrapper">
                    <button class="button">Follow</button>
                    <button class="button">Unfollow</button>
                    <button class="button">Request Admission</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
function selectFile(id) {
  document.getElementById(id).click(); return false;
}
function fileSelected(e) {
  e.nextElementSibling.classList.add("selected")
}
</script>
@endsection
