<?php

namespace App\Controller;

use App\ExpressTest\Dto\TestStateDto;
use App\ExpressTest\Loader\Answer\AnswerStrategyInterface;
use App\ExpressTest\Loader\Question\NextQuestionStrategyInterface;
use App\ExpressTest\Loader\StateLoaderInterface;
use App\ExpressTest\UseCase\DisplayTestInterface;
use App\ExpressTest\UseCase\TestResultInterface;
use App\ExpressTest\Workflow\ExpressTestResult;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExpressTestController extends AbstractController
{
    private const CACHE_KEY = 'currentTest';
    /**
     * @throws Exception
     */
    #[Route('/', name: 'app.index', methods: ["GET"])]
    public function index(
        DisplayTestInterface $displayTest,
        StateLoaderInterface $stateLoader,
        NextQuestionStrategyInterface $nextQuestionStrategy,
        AnswerStrategyInterface $answerStrategy,
        TestResultInterface $expressTestResult,
    ): Response {

        $state = $stateLoader->loadState(self::CACHE_KEY);
        if ($state) {
            $q = $nextQuestionStrategy->getNextQuestion($state);
            if ($q) {
                $answers = $answerStrategy->getAnswers($q->questionId);
                return $this->render('question.html.twig',
                    ['question' => $q, 'answers' => $answers, 'testId' => $state->getTestId()]);
            } else {
                $result = $expressTestResult->calcResults($state);
                $stateLoader->removeState(self::CACHE_KEY);
                return $this->render('results.html.twig', ['result' => $result]);
            }
        }

        $tests = $displayTest->getTestsForDisplay();
        return $this->render('index.html.twig', ['tests' => $tests]);
    }

    #[Route('/begin', name: 'app.begin.test', methods: ["POST"])]
    public function beginTest(
        Request $request,
        StateLoaderInterface $stateLoader
    ): Response {
        $s = new TestStateDto($request->getPayload()->getInt('testId'));

        $stateLoader->saveState($s, self::CACHE_KEY);
        return $this->redirectToRoute('app.index');
    }

    /**
     * @throws Exception
     */
    #[Route('/answer', name: 'app.answer', methods: ["POST"])]
    public function answer(
        Request $request,
        StateLoaderInterface $stateLoader,
    ): Response {
        $answers = $request->getPayload()->all('answers');
        $testId  = $request->getPayload()->getInt('testId');
        $questionId = $request->getPayload()->getInt('questionId');

        $state = $stateLoader->loadState(self::CACHE_KEY);
        if (null === $state) {
            return $this->redirectToRoute('app.index');
        }

        if ($state->getTestId() !== $testId) {
            throw new Exception("Ошибка данных");
        }

        if([] === $answers) {
            $this->addFlash('tip', "Нужно выбрать хотябы один ответ.");
            return $this->redirectToRoute('app.index');
        }

        $state->addAnswers($questionId, $answers);
        $stateLoader->saveState($state, self::CACHE_KEY);

        return $this->redirectToRoute('app.index');
    }
}