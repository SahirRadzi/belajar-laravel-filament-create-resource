<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\DB;
use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Contracts\Pagination\Paginator;


class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
    return $query->simplePaginate(($this->getTableRecordsPerPage() === 'all') ? $query->count() : $this->getTableRecordsPerPage());
    }

    public function getTabs(): array
    {
        $orderCounts = DB::table('orders')
        ->select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get()
        ->pluck('count', 'status');

    // Get total appointments
    $all = $orderCounts->sum();

    // Get counts for specific statuses
    $pending = $orderCounts->get('pending', 0);
    $processing = $orderCounts->get('processing', 0);
    $completed = $orderCounts->get('completed', 0);
    $cancelled = $orderCounts->get('cancelled', 0);


    return[

            'All Order' => Tab::make()
            ->badge($all)
            ->badgeColor('primary'),

            'Pending' => Tab::make()

            ->badge($pending)
            ->badgeColor('danger')
            ->modifyQueryUsing(function ($query) {
               return $query->where('status','pending');

            }),

           'Processing' => Tab::make()
            ->badge($processing)
            ->badgeColor('info')
            ->modifyQueryUsing(function ($query) {
            return $query->where('status','processing');

            }),

           'Completed' => Tab::make()
            ->badge($completed)
            ->badgeColor('success')
            ->modifyQueryUsing(function ($query) {
            return $query->where('status','completed');

            }),

           'Cancelled' => Tab::make()
            ->badge($cancelled)
            ->badgeColor('warning')
            ->modifyQueryUsing(function ($query) {
            return $query->where('status','cancelled');

            }),

        ];

    }


}
