<div id="ting">
    <h1 class="tingHeader">
        Tings
        <img src="ting/dist/svgs/ting.svg">
    </h1>
    <div class="tingHolder js-tings" id="tings" data-parentID="$ID">
        <% loop $getTings %>
            $IncludeTemplate
        <% end_loop %>
    </div>

    <div class="tingCreators" data-parentID="$ID">
        <span class="js-create-ting" data-parentID="$ID" data-type="TextTing">text</span>
        <span class="js-create-ting" data-parentID="$ID" data-type="ImageTing">image</span>
        <span class="js-create-ting" data-parentID="$ID" data-type="VideoTing">video</span>
    </div>

</div>

<div class="tingForm js-ting-form">

</div>
