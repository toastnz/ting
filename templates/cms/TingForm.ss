<div class="ting--form">
    <div class="innerWrap">
        <form $FormAttributes>
            <% loop $Fields %>
                $Field
            <% end_loop %>
            <div class="tingActions">
                <% loop $Actions %>
                    $Field
                <% end_loop %>
            </div>
        </form>
    </div>
</div>
