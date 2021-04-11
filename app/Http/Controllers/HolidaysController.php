<?php


namespace App\Http\Controllers;


use App\Http\Resources\HolidayResource;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HolidaysController extends Controller
{
    public function index()
    {

        $hol = [];
        $this->year = Carbon::now()->format('Y');

        $years = [];
        $lastFiveYear = (int)Carbon::now()->subYears(5)->format('Y');
        $nextYear = (int)Carbon::now()->addYear()->format('Y');

        for($i=$lastFiveYear;$i <= $nextYear;$i++ ){
            $years [] =$i;
        }
        $this->years = $years;

        $this->holidays = Holiday::orderBy('date', 'ASC')
            ->where(DB::raw('Year(holidays.date)'), '=', $this->year)
            ->get();


        $dateArr = $this->getDateForSpecificDayBetweenDates($this->year . '-01-01', $this->year . '-12-31', 0);
        $this->number_of_sundays = count($dateArr);

        $this->holidays_in_db = count($this->holidays);

        foreach ($this->holidays as $holiday) {
            $hol[date('F', strtotime($holiday->date))]['id'][] = $holiday->id;
            $hol[date('F', strtotime($holiday->date))]['date'][] = $holiday->date->format('Y-m-d');
            $hol[date('F', strtotime($holiday->date))]['ocassion'][] = ($holiday->occassion)? $holiday->occassion : 'Not Define';
            $hol[date('F', strtotime($holiday->date))]['day'][] = $holiday->date->format('D');
        }
        $this->holidaysArray = $hol;

        return response()->json([
            'holidaysArray' => $this->holidaysArray,
            'number_of_sundays' => $this->number_of_sundays,
            'holidays_in_db' => $this->holidays_in_db
        ]);
    }

    public function getDateForSpecificDayBetweenDates($startDate, $endDate, $weekdayNumber)
    {
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        $dateArr = [];

        do {
            if (date('w', $startDate) != $weekdayNumber) {
                $startDate += (24 * 3600); // add 1 day
            }
        } while (date('w', $startDate) != $weekdayNumber);


        while ($startDate <= $endDate) {
            $dateArr[] = date('Y-m-d', $startDate);
            $startDate += (7 * 24 * 3600); // add 7 days
        }

        return ($dateArr);
    }

    public function store()
    {
//        dd(request()->all());
        $holiday = array_combine(request('date'), request('date'));
        foreach ($holiday as $index => $value) {
            if ($index){
                Holiday::firstOrCreate([
                    'date' => Carbon::createFromFormat('Y-m-d', $index)->format('Y-m-d'),
                    'occassion' => Carbon::createFromFormat('Y-m-d', $index)->format('l'),
                ]);
            }
        }

        return Response::success()->withMessage('تمت العملية بنجاح')->send();
    }

    /**
     * Display the specified holiday.
     */
    public function find($id)
    {
        $holiday = new HolidayResource(Holiday::findOrFail($id));

        return Response::success($holiday)->withMessage('تمت العملية بنجاح')->send();
    }

    public function update(Request $request, $id)
    {
        $holiday = Holiday::findOrFail($id);
        $data =$request->all();
        $holiday->update([
            'date' => Carbon::createFromFormat('Y-m-d', $data['date'])->format('Y-m-d'),
            'occassion' => Carbon::createFromFormat('Y-m-d', $data['date'])->format('l'),
        ]);

        return Response::success(new HolidayResource($holiday))->withMessage('تمت العملية بنجاح')->send();
    }

    public function destroy($id)
    {
        Holiday::destroy($id);
        return Response::success()->withMessage('تمت العملية بنجاح')->send();
    }

    public function holidayStoreDays()
    {
        $year = Carbon::now()->format('Y');

        foreach (\request('day') as $day)
        {
            $dateArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', $day); // Friday

            foreach ($dateArr as $date) {
                Holiday::firstOrCreate([
                    'date' => $date,
                    'occassion' => Carbon::createFromFormat('Y-m-d', $date)->format('l'),
                ]);
            }
        }

        return Response::success()->withMessage('تمت العملية بنجاح')->send();
    }

    public function holidayCalendar($year = null){

        $hol = [];
        $this->year = Carbon::now()->format('Y');

        if($year){
            $this->year = $year;
        }

        $years = [];
        $lastFiveYear = (int)Carbon::now()->subYears(5)->format('Y');
        $nextYear = (int)Carbon::now()->addYear()->format('Y');

        for($i=$lastFiveYear;$i <= $nextYear;$i++ ){
            $years [] =$i;
        }
        $this->years = $years;

        $holidays = Holiday::where(DB::raw('Year(holidays.date)'), '=', $this->year)->get();

        foreach ($holidays as $holiday) {
            $hol[date('F', strtotime($holiday->date))]['id'][] = $holiday->id;
            $hol[date('F', strtotime($holiday->date))]['date'][] = $holiday->date->format('Y-m-d');
            $hol[date('F', strtotime($holiday->date))]['ocassion'][] = ($holiday->occassion)? $holiday->occassion : 'Not Define';
            $hol[date('F', strtotime($holiday->date))]['day'][] = $holiday->date->format('D');
        }
        $this->holidaysArray = $hol;

        return Response::success($this->holidaysArray)->withMessage('تمت العملية بنجاح')->send();
    }

    public function getCalendarMonth(Request $request){
        $month = Carbon::createFromFormat('Y-m-d', $request->startDate)->format('m');
        $year = Carbon::createFromFormat('Y-m-d', $request->startDate)->format('Y');
        $holidays = Holiday::whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->get();

        $hol = [];

        foreach ($holidays as $holiday) {
            $hol[date('F', strtotime($holiday->date))]['id'][] = $holiday->id;
            $hol[date('F', strtotime($holiday->date))]['date'][] = $holiday->date->format('Y-m-d');
            $hol[date('F', strtotime($holiday->date))]['ocassion'][] = ($holiday->occassion)? $holiday->occassion : 'Not Define';
            $hol[date('F', strtotime($holiday->date))]['day'][] = $holiday->date->format('D');
        }
        $this->holidaysArray = $hol;
       return $this->holidaysArray;
    }
}
