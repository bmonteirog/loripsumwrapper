<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';

$loripsum = new Loripsum\Wrapper;

echo $loripsum->render(); // Render 4 paragraphs in default Mode

/*
Response:

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quid dubitas igitur mutare principia naturae? Duo enim genera quae erant, fecit tria. Nihilo beatiorem esse Metellum quam Regulum. Duo Reges: constructio interrete. Illa tamen simplicia, vestra versuta. Varietates autem iniurasque fortunae facile veteres philosophorum praeceptis instituta vita superabat. Si verbum sequimur, primum longius verbum praepositum quam bonum. Sed fac ista esse non inportuna; </p>

<p>An potest, inquit ille, quicquam esse suavius quam nihil dolere? Et quidem, Cato, hanc totam copiam iam Lucullo nostro notam esse oportebit; Sed tamen enitar et, si minus multa mihi occurrent, non fugiam ista popularia. Nos cum te, M. Te enim iudicem aequum puto, modo quae dicat ille bene noris. </p>

<p>Omnes enim iucundum motum, quo sensus hilaretur. Nihil opus est exemplis hoc facere longius. Quid ei reliquisti, nisi te, quoquo modo loqueretur, intellegere, quid diceret? Cur, nisi quod turpis oratio est? </p>

<p>Quamquam non negatis nos intellegere quid sit voluptas, sed quid ille dicat. Non quam nostram quidem, inquit Pomponius iocans; Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Quamquam te quidem video minime esse deterritum. Huius, Lyco, oratione locuples, rebus ipsis ielunior. Eadem nunc mea adversum te oratio est. Videsne quam sit magna dissensio? Quid censes in Latino fore? </p>
*/

echo $loripsum->length('short')
               ->withLinks()
               ->render(2); // Render 2 short paragraphs with links
/*
Response:

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quid enim possumus hoc agere divinius? <a href='http://loripsum.net/' target='_blank'>Nihil sane.</a> Quid de Pythagora? <a href='http://loripsum.net/' target='_blank'>Comprehensum, quod cognitum non habet?</a> Duo Reges: constructio interrete. Suo genere perveniant ad extremum; </p>

<p>Bonum liberi: misera orbitas. Sed quod proximum fuit non vidit. <a href='http://loripsum.net/' target='_blank'>Que Manilium, ab iisque M.</a> Ecce aliud simile dissimile. <a href='http://loripsum.net/' target='_blank'>Non autem hoc: igitur ne illud quidem.</a> </p>
*/
?>
