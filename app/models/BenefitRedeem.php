<?php
class BenefitRedeem extends LocationModel {
    protected $table = 'beneficios_cobrados';

    public function benefit()
    {
        return $this->belongsTo('Benefit', 'beneficio_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'usuario_id');
    }

    static public function redeem($id, $user_id, $lat, $lng)
    {
        $benefit = Benefit::with('locations')->find($id);
	    foreach ($benefit->locations as $location)
	    {
		    $distance_to_target = self::calculateDistance(array('lat' => $lat, 'lng' => $lng), array('lat' => $location->lat, 'lng' => $location->lng));
		    if ($benefit && $distance_to_target <= Config::get('app.search_limit', 50) && $distance_to_target >= 0)
		    {
			    $redeemed = new BenefitRedeem();
			    $redeemed->beneficio_id = $id;
			    $redeemed->usuario_id = $user_id;
			    if ($redeemed->save())
			    {
				    Auth::getUser()->recalculateLevel();
				    return true;
			    }
		    }
	    }
        return false;
    }
} 