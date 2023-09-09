<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;

use App\Models\Event;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }


    public function create()
    {
        return view('posts.create');
    }

    public function filterEvent(String $rangeDate){

        if($rangeDate == "All"){
            return Inertia::render('Welcome', [
                'eventList' => Event::all()
            ]);
        }
        $start_date = $this->convertDateFormat($rangeDate)['start'];
        $end_date = $this->convertDateFormat($rangeDate)['end'];


        $events = Event::where(function ($query) use ($start_date, $end_date) {
            $query->whereBetween('start_date', [$start_date, $end_date])
                  ->orWhereBetween('end_date', [$start_date, $end_date])
                  ->orWhere(function ($query) use ($start_date, $end_date) {
                      $query->where('start_date', '<', $start_date)
                            ->where('end_date', '>', $end_date);
                  });
        })->get();

        return Inertia::render('Welcome', [
            'eventList' => $events
        ]);

        
    }

    public function store(Request $request)
    {
        //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
        //$out->writeln($request);

        $jsonData = $request->json()->all();
        $title = $jsonData['title'];
        $description = $jsonData['description'];
        $dateRange = $this->convertDateFormat($jsonData['date']);
        // Validez et enregistrez les données du formulaire dans la base de données
        // Redirigez ensuite vers la page d'affichage de l'article créé
        if ($dateRange !== null) {
            $startDate = $dateRange['start'];
            $endDate = $dateRange['end'];
        
            // Now you can use $startDate and $endDate as needed
           // $out->writeln("title: ".$title." ,description: ".$description." ,startDate: ".$startDate." ,endDate: ".$endDate);
            
            $event = new Event();
            $event->title = $title;
            $event->description = $description;
            $event->start_date = $startDate;
            $event->end_date = $endDate;
            $event->save();
            

        }

    }

    public function getEventData(){
        $events = Event::all();

        return Inertia::render('Welcome', [
            'events' => $events,
        ]);
    }

    private function convertDateFormat($inputDateRange)
    {
        // Split the date range into start and end dates
        $dateRangeParts = explode(' - ', $inputDateRange);
    
        if (count($dateRangeParts) === 2) {
            $startParts = explode('/', trim($dateRangeParts[0]));
            $endParts = explode('/', trim($dateRangeParts[1]));
    
            if (count($startParts) === 3 && count($endParts) === 3) {
                $startDate = $startParts[2] . '-' . $startParts[1] . '-' . $startParts[0];
                $endDate = $endParts[2] . '-' . $endParts[1] . '-' . $endParts[0];
    
                // Check if both dates are valid before returning
                if (strtotime($startDate) !== false && strtotime($endDate) !== false) {
                    return ['start' => $startDate, 'end' => $endDate];
                }
            }
        }
    
        // Return null or handle invalid input as needed
        return null;
    }
    
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        // Validez et mettez à jour les données du formulaire dans la base de données
        // Redirigez ensuite vers la page d'affichage de l'article mis à jour
    }

    public function destroy($id)
    {
        // Trouvez l'article à supprimer et supprimez-le
        // Redirigez ensuite vers la liste des articles

    }
}
