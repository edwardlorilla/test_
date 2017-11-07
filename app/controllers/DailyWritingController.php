<?php
use ilys\Validators\WordCountGetter;
use ilys\Validators\ValidationException;
use ilys\DataMapper\WordCountsByDayMapper;
class DailyWritingController extends ApiController {


    protected $validator,$dailyWritingLog;

    function __construct(WordCountGetter $validator ,DailyWritingLog $dailyWritingLog , WordCountsByDayMapper $wordCountsByDayMapper )
    {
        $this->validator = $validator;
        $this->dailyWritingLog = $dailyWritingLog;
        $this->wordCountsByDayMapper = $wordCountsByDayMapper;
    }


    public  function index()
    {
        return View::make('dailywriting.index');
    }

	public function getWordCountByDates()
    {
        try
        {
            if ( $this->validator->isValid(Input::all()) )
            {
                $start_date = Input::get('start');
                $end_date = Input::get('stop');
                $start_date =  date('Y-m-d' ,strtotime($start_date));
                $end_date = date('Y-m-d' ,strtotime($end_date));

                $result = array();
                $data = $this->dailyWritingLog->userWordCountBetweenDates($start_date,$end_date);

                if($data!=null)
                {
                    foreach($data as $item)
                    $result[strtotime($item->date)] =(int) $item->daily_word_count;
                    return  $this->response($result);
                }

                return $this->response(array());
            }

            throw new ValidationException('Error.  ' , $this->validator->getErrors());

        }
        catch (ValidationException $e)
        {
            return $this->responseWithError($e->getErrors()->toArray());
        }
    }
}
