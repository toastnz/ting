<div id="ting">
    <div class="tingHolder js-tings" id="tings" data-parentID="$ID">
        <% loop $getTings %>
            $IncludeTemplate
        <% end_loop %>
    </div>

    <div class="tingCreators" data-parentID="$ID">
        <span class="js-create-ting" data-parentID="$ID" data-type="TextTing">text</span>
        <span class="js-create-ting" data-parentID="$ID" data-type="ImageTing">image</span>
        <span class="js-create-ting" data-parentID="$ID" data-type="VideoTing">video</span>
        <span class="js-add-ting" data-parentID="$ID" data-type="QuoteTing">quote</span>
        <span class="js-add-ting" data-parentID="$ID" data-type="FileTing">file</span>
    </div>

</div>

<div class="tingForm js-ting-form">

</div>
