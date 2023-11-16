@extends ($auth['role_id'] == 2 ? 'layouts.menuEscolar' : 'layouts.main')

@section('title', 'PSE')

@section('content')

<div class="col-md-6 dashboard-title-container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <!-- <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="/img/pse_logo.png" class="d-block w-100 img-fluid" alt="Logo do PSE">
            </div>
            <div class="carousel-item">
            <img src="/img/aluno.png" class="d-block w-100 img-fluid" alt="Imagem de Aluno">
            </div>
            <!-- <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div> -->
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>
</div>

<div class="col-md-4 dashboard-title-container">
    <h1>Programa Saúde nas Escolas</h1>
    <p>
        O Programa Saúde na Escola (PSE) visa à integração e articulação permanente da educação e da saúde,
        proporcionando melhoria da qualidade de vida da população brasileira. Como consolidar essa atitude dentro das escolas?
        Essa é a questão que nos guiou para elaboração da metodologia das Agendas de Educação e Saúde, a serem executadas como
        projetos didáticos nas Escolas.
    </p>

    <p>
        O PSE tem como objetivo contribuir para a formação integral dos estudantes por meio de ações de promoção, prevenção
        e atenção à saúde, com vistas ao enfrentamento das vulnerabilidades que comprometem o pleno desenvolvimento de crianças
        e jovens da rede pública de ensino.
    </p>

    <p>
        O público beneficiário do PSE são os estudantes da Educação Básica, gestores e profissionais de educação e saúde,
        comunidade escolar e, de forma mais amplificada, estudantes da Rede Federal de Educação Profissional e Tecnológica e
        da Educação de Jovens e Adultos (EJA).
    </p>
    <p>Para mais Informações no portal do MEC. <a rel="noopener noreferrer" href="http://portal.mec.gov.br/expansao-da-rede-federal/194secretarias-112877938/secad-educacao-continuada-223369541/14578-programa-saude-nas-escolas" target="_blank">Clique aqui</a>
  
    </p>
</div>


@endsection