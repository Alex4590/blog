<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php foreach ($news as $value){
                $out = '<div class="media">';
                $out .= '<div class="media-body">';
                $out .= '<div class="text">'.$value['text'].'</div>';
                $out .= '<p class="media-heading text-right"><i>'.$value['autor'].'</i></p>';
                $out .= '</div>';
                $out .= '</div>';
                echo $out;
            }?>
        </div>
    </div>
</div>