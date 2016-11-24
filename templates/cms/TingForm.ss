<div class="ting--form">
    <div class="innerWrap">
        <form $FormAttributes>
            <h2>Edit Block</h2>
            <% loop $Fields %>
                $Field
            <% end_loop %>
            <% loop $Actions %>
                $Field
            <% end_loop %>
        </form>
    </div>
</div>
