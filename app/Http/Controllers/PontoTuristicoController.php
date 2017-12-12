<?php

namespace TurOnline\Http\Controllers;

//use Faker\Provider\File;
use function GuzzleHttp\Psr7\_parse_request_uri;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Psy\Util\Json;
use TurOnline\ImgPontos;
use TurOnline\PontoTurismo;
use TurOnline\RegisterQrAccess;
use TurOnline\TrataImagens;
use TurOnline\User;
use File;

class PontoTuristicoController extends Controller
{
    private $pTur;

    /**
     * PontoTuristicoController constructor.
     * @param $pTur
     */
    public function __construct(PontoTurismo $pTur)
    {
        $this->pTur = $pTur;
    }

    public function mobile()
    {
        return "aqui";
    }


    public function index()
    {
        $cadastros = PontoTurismo::all();

        return view('admin.pt_turistico.pt_index', compact('cadastros'));
    }


    public function show($id)
    {
        $pontoTur = PontoTurismo::find($id);
//        dd($pontoTur);
        if (count($pontoTur) > 0):
            return view('admin.pt_turistico.pt_show', compact('pontoTur'));
        else:
            return redirect()->route('admin.ponto-turistico.index')->withErrors('Registro não encotrado :(');
        endif;
    }

    /*
     * Mostra o ponto turistico cadastrado no QrCode disponível nos locais estratégicos na cidade
     */
    public function showPontoTur($id)
    {
        //registra os dados do cliente para fins de estatística.
        $registros = new RegisterQrAccess();
        $registros->create($registros->dados());

        $pontoTur = PontoTurismo::find($id);


//        $galeria = ImgPontos::where('pontotur_id', $id)->get();
//        dd($galeria);
        if (count($pontoTur) > 0):
            $path_file = \request()->getHttpHost() . "/" . $pontoTur->img_capa;
            $pontoTur->img_capa = $path_file;

            $imagens = ImgPontos::where('pontotur_id',$id)->get(['path_file_p']);

            $raiz = "http://".\request()->getHttpHost() . "/";
            foreach ($imagens as $imagen){
                $img[] = ['imagen'=>$raiz.$imagen->path_file_p];
            }
            $pontoTur->galeria = $img;
//            dd($imagens);
            return response()->json($pontoTur, 200, [], JSON_UNESCAPED_SLASHES);
//            return view('view_public.show', compact('pontoTur'));
        else:
            return \response()->json('Nenhum registro encontrado!');
        endif;
    }

    /*
     * redireciona para a view que vai gerar o qrCode com o id
     */
    public
    function gerarQrCode($id)
    {
        $pontoTur = PontoTurismo::find($id);
        if (count($pontoTur) > 0):
            return view('admin.pt_turistico.qrcode', compact('pontoTur'));
        else:
            return redirect()->route('admin.ponto-turistico.index')->withErrors('Registro não encotrado :(');
        endif;
    }


//||||||||||||||||||||||||||||||||||||Aqui começa o CRUD|||||||||||||||||||||||||||||||||||||||||||||||||||||\\

    public
    function create()
    {
        return view('admin.pt_turistico.pt_create');
    }


    /*
     * Criar um novo registro na tabela de pontos turísticos.
     */
    public
    function store(Request $r)
    {
//        dd($r->all());
//        $f = Storage::disk('local')->put($r-
//        $ip = $r->getClientIp();
//        Log::info('oi estou aqui');

//        dd($ip);
//        $store = new PontoTurismo();
        $cadastrado = $this->pTur->create($this->pTur->formataDados($r));

        return redirect()->route('admin.ponto-turistico.index');
    }


    public
    function edit(Request $r, $id)
    {
        $pontoTur = PontoTurismo::find($id);
        if (count($pontoTur) > 0):
            return view('admin.pt_turistico.pt_edit', compact('pontoTur'));
        else:
            return redirect()->route('admin.ponto-turistico.index')->withErrors('Não é possível editar um registro inexistente');
        endif;
    }


    public
    function update(Request $r, $id)
    {
        $pontoTur = PontoTurismo::find($id);
        if (count($pontoTur) > 0):
            $pontoTur->update($this->pTur->formataDados($r));
            //após ser cadastrado o ponto turistico no banco, cadastra-se a imagem relativa a esse ponto ||código abaixo||


            return back();
        endif;
    }


    public
    function destroy($id)
    {
        $pontoTur = $this->pTur->find($id);
        if (count($pontoTur) > 0):
            $gallery = $pontoTur->imgPontos;
            $deletado = $pontoTur->delete();

            if ($deletado):
//                dd($gallery);
                File::delete($pontoTur->img_capa);


                if (count($gallery) > 0) {
                    foreach ($gallery as $galeria) {
                        //deleta as imagens da galeria relacionadas a esse ID
                        $galeria->delete();
                        File::delete($galeria->path_file_p);
                    }
                }
                return redirect()->route('admin.ponto-turistico.index')->with('status', 'Deletado com sucesso');
            endif;
        else:
            return redirect()->route('admin.ponto-turistico.index')->withErrors('Registro não encotrando');
        endif;
    }

########################################## Fim do CRUD #######################################################3


##############################################################################################################
############################# GALERIA DE IMAGENS #############################################################
##############################################################################################################
    public
    function createGallery($id)
    {
        $pontoTur = $this->pTur->find($id);
        if (count($pontoTur) > 0):
//            $imagens = $pontoTur->imgPontos;
            $imagens = ImgPontos::where('pontotur_id',$id)->get(['path_file_p']);

            $raiz = \request()->getHttpHost() . "/";
            foreach ($imagens as $imagen){
                $img[] = ['imgens'=>$raiz.$imagen->path_file_p];
            }
            return \response()->json($img,200,[],JSON_UNESCAPED_SLASHES);
//            foreach ($imagens as $img) {
//                $imagem[] = [ 'imagens'=>$raiz . $img->path_file_p];
//            }

            dd($img);
            $imagens = (count($imagens) > 0 ? $imagens : $imagens = null);
            return view('admin.pt_turistico.pt_create_gallery', compact('pontoTur', 'imagens', 'raiz'));
        else:
            return back()->withErrors('Registro não encotrando');
        endif;
    }


    public
    function store_gallery(Request $request)
    {
//        dd($request->galeria);
        $galeria = new ImgPontos();
        $imagem = new TrataImagens();
        foreach ($request->galeria as $img) {
            ImgPontos::create([
                'path_file_p' => $imagem->createImagem($img, "galeria", 400),
                'pontotur_id' => $request->pontotur_id,
            ]);
        }

        return back();
//        return Response()->json(['success'=> true]);
    }

    public function gallery_show($id)
    {

    }

##################################################################################################################
############################# FIM GALERIA DE IMAGENS #############################################################
##################################################################################################################




##################################################################################################################
############################# INICIO XML #########################################################################
##################################################################################################################

    public function gerarXml()
    {
        $link = "http://www.agencia.ac.gov.br/evento/evento-cultural/feed/"; //link do arquivo xml
        $xml = simplexml_load_file($link)->channel; //carrega o arquivo XML e retornando um Array

        foreach ($xml->item as $item) {
            $dados[] = [
                'description' => (string)$item->description,
            ];
        }
//        dd($dados);
        return response()->json($dados, 200, [], JSON_UNESCAPED_UNICODE);
//        return view('admin.pt_turistico.xml', compact('xml'));
    }

    public function xml_Cultura()
    {
        $link = "http://www.agencia.ac.gov.br/categoria/noticias/cultura/feed/";
        $xml = simplexml_load_file($link)->channel; //carrega o arquivo XML e retornando um Array

        foreach ($xml->item as $item) {
            $dados[] = [
                'description' => (string)$item->description,
            ];
        }
//        dd($dados);
        return response()->json($dados, 200, [], JSON_UNESCAPED_UNICODE);
    }


    public function xml_musica()
    {
        $link = "http://www.agencia.ac.gov.br/evento/musica/feed/";
        $xml = simplexml_load_file($link)->channel; //carrega o arquivo XML e retornando um Array

        foreach ($xml->item as $item) {
            $dados[] = [
                'description' => (string)$item->description,
            ];
        }
//        dd($dados);
        return response()->json($dados, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
