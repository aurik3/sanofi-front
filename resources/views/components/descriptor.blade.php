<div class="jumbotron descriptor">
    <h2 class="text-yellow">
        {{ $title }}
    </h2>
    <hr class="my-4">
    <p class="lead d-none d-lg-block" style="padding: 0 15vw 0 15vw !important;">
        {{ $content }}
    </p>
    <div class="d-lg-none" >
        <a class="btn btn-yellow" data-toggle="collapse" href="#descriptorCollapse" role="button" aria-expanded="false" aria-controls="descriptorCollapse" style="width: 75%">
            Ver más
        </a>
        <div class="collapse" id="descriptorCollapse" style="text-align: justify !important;">
            <p class="lead" style="padding: 5vh 5vw 0 5vh !important;">
                {{ $content }}
            </p>
        </div>
    </div>
</div>
