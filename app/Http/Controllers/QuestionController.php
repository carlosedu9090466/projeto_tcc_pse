<?php

namespace App\Http\Controllers;

use App\Models\Doenca;
use App\Models\Question;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class QuestionController extends Controller
{

    public function index()
    {
        //faz o relacionamento
        $questions = Question::with('doencas')->get();

        return view('question.home', ['questions' => $questions]);
    }

    public function create()
    {
        $doencas = Doenca::all();
        return view('question.create', ['doencas' => $doencas]);
    }

    public function store(Request $request)
    {


        $regras = [
            'pergunta' => 'required|array|min:5|max:100',
            'doenca_id' => 'exists:doencas,id'
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.',
            'pergunta.min' => 'A pergunta deve ter no mínino 5 caracteres',
            'pergunta.max' => 'A pergunta deve ter no máximo 100 caracteres',
            'doenca_id.exists' => 'A doença informada não existe'
        ];
        //$request->validate($regras, $feedback);
        //dd('ok');
        $dados = $request->pergunta;
        $doenca = $request->doenca_id;
        $discurvisa = $request->discursiva;

        foreach ($dados as $dado) {
            $question = new Question;
            if (empty($dado) || $doenca === '0') {
                return redirect('/question/create')->with('msg', 'Preencha os dados!');
            }
            $question->pergunta = $dado;
            $question->doenca_id = $request->doenca_id;
            if ($discurvisa === '1') {
                $question->discursiva = $request->discursiva;
            }
            $question->save();
        }
        //$question->pergunta = $request->pergunta;
        //$question->doenca_id = $request->doenca_id;

        return redirect('/question/home')->with('msg', 'perguntas cadastradas com sucesso!');
    }

    public function edit($id)
    {

        //$question = Question::findOrFail($id)->with('doencas')->get();
        $question = Question::with('doencas')->findOrFail($id);
        //dd($question);
        return view('question.edit', ['question' => $question]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        //dd($data);
        Question::findOrFail($request->id)->update($data);

        return redirect('/question/home')->with('msg', 'Dados editado com sucesso!');
    }

    public function destroy($id)
    {
        Question::findOrFail($id)->delete();

        return redirect('/question/home')->with('msg', 'Dado excluido com sucesso!');
    }
}
