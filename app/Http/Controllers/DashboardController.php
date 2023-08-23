<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Http;
    use App\Models\DataFeed;
    use Carbon\Carbon;

    class DashboardController extends Controller
    {

        /**
         * Displays the dashboard screen
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
         */
        public function indexHRD()
        {
            $dataFeed = new DataFeed();

            return view('pages/dashboard/dashboard', ['title' => 'Dashboard'] ,compact('dataFeed'));
        }

        public function indexManajer()
        {
            $dataFeed = new DataFeed();

            return view('pages/dashboard/dashboard-manajer', ['title' => 'Dashboard'] ,compact('dataFeed'));
        }
    }
