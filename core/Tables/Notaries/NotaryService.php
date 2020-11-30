<?php
namespace Core\Tables\Notaries;

class NotaryService
{
    public function getTotal(
        $delayed_od,
        $delayed_prc,
        $delayed_fines,
        $notary_cost
    )
    {
        $total = ($delayed_od + $delayed_prc + $delayed_fines);

        if ($notary_cost != null){
            $TotalWithNotaryCost = ($total + $notary_cost);
            return [$total, $TotalWithNotaryCost];
        }

        return [$total, null];
    }
}
