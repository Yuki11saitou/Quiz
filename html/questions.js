// 解答の選択肢一覧を取得
// olの中のliを指定するときは以下の書き方でOK。li等、対象が複数あるときはquerySelectorAllメソッド使用。
const answersList = document.querySelectorAll('ol.answers li');

// クリックされたときの処理を仕込む
answersList.forEach(li => li.addEventListener('click', checkClickedAnswer));


// eventを第一引数にすることで、clickというイベントが発生した瞬間に起こる処理を「event.〇〇」で記述できる
function checkClickedAnswer(event) {

    // addEventListenerによって反応した要素(この実装ではli要素)
    const clickedAnswerElement = event.currentTarget;

    // 選択した答え(A,B,C,D) *「.dataset.answer」はhtmlで指定した「data-answer」をJS用に読み替えたもの
    // dataset は HTMLElement インターフェイスの読み取り専用プロパティで、要素に設定されたすべてのカスタムデータ属性 (data-*) への読み取り/書き込みアクセスを提供する。
    const selectedAnswer = clickedAnswerElement.dataset.answer;
    //⇒回答を収集(A,B,C,D)

    // 親要素のolから、data-idの値を取得 *「dataset.id」はhtmlで指定した「data-id」をJS用に読み替えたもの
    // 親要素の指定には closest('ol.answers') のように書く
    const questionId = clickedAnswerElement.closest('ol.answers').dataset.id;
    //⇒回答が含まれている「元の問題」の、連想配列のidを取得

    // フォームデータの入れ物を作る
    const formData = new FormData();
    // 送信したい値を追加
    //ここで'id' = questionId, 'selectedAnswer' = selectedAnswerとして、answer.phpで扱えるようになる
    formData.append('id', questionId);
    formData.append('selectedAnswer', selectedAnswer);
    //⇒回答フォームに入力された「回答の問題に対応するid」と「回答(A,B,C,D)」を”formData”に代入

    // xhr = XMLHttpRequestの頭文字 *XMLHttpRequest()もオフジェクト。
    const xhr = new XMLHttpRequest();
    // HTTPメソッドをPOSTに指定、送信するURLを指定
    xhr.open('POST', 'answer.php');
    // フォームデータを送信
    xhr.send(formData);
    //⇒POSTで、宛先'answer.php'にデータを送信

    // loadendはリクエストが完了したときにイベントが発生する
    xhr.addEventListener('loadend', function(event){
        //イベント発生元のオブジェクト(インスタンス)である「XMLHttpRequest()オブジェクト」がevent.currentTargetになるため、xhrに再代入。
        const xhr = event.currentTarget;

        //リクエストが成功したかステータスコードで確認
        //ステータスコードは、ブラウザから 開発者ツール>ネットワーク で参照可能
        if (xhr.status === 200){
            //サーバーからのレスポンスはJSONコードになっているため、JSON.parse()を使ってオブジェクトに変換する必要がある。
            const response = JSON.parse(xhr.response);

            //答えが正しいか判定
            //「response.result」ではanswer.phpの$responseの連想配列に入っている要素$resultを左辺に代入している
            const result = response.result ;
            const correctAnswer = response.correctAnswer;
            const correctAnswerValue = response.correctAnswerValue;
            const explanation = response.explanation;

            //画面表示。下で定義
            displayResult (result, correctAnswer, correctAnswerValue, explanation);
        } else {
            //エラー
            alert('Error:回答データの取得に失敗しました');
        }
    });
}


function displayResult (result, correctAnswer, correctAnswerValue, explanation){
    // メッセージを入れる変数を用意
    let message;
    // カラーコードを入れる変数を用意
    let answerColorCode;

    // 答えが正しいか判定
    if (result) {
        // 正しい答えだったとき
        message = '正解です！おめでとう！';
        answerColorCode = '';
    } else {
        // 間違えた答えだったとき
        message = 'ざんねん！不正解です！';
        answerColorCode = '#f05959';
    }

    // アラートで正解・不正解を出力
    alert(message);

    //正解の内容をHTMLに組み込む(追加で書き込む)
    //JSでの文字列の連結には「+」を使う。PHPでは「.」
    document.querySelector('span#correct-answer').innerHTML = correctAnswer +'. ' + correctAnswerValue;
    document.querySelector('span#explanation').innerHTML = explanation;

    // 色を変更(間違っていたときだけ色が変わる)
    document.querySelector('span#correct-answer').style.color = answerColorCode;
    // 答え全体を表示
    document.querySelector('div#section-correct-answer').style.display = 'block';
}
