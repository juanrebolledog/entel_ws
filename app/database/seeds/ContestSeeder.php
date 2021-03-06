<?php
class ContestSeeder extends Seeder {
    public function run()
    {
        DB::table('concursos')->delete();
        DB::table('concursos_ganadores')->delete();
	    Eloquent::unguard();

        foreach (range(1, 10) as $i)
        {
            $contest = Contest::create(array(
                'nombre' => 'Concurso #' . $i,
                'descripcion' => 'Las personas hicieron colas increíbles para que no les dieran nada. Aquí los ganadores que perdieron mas tiempo.',
                'imagen_banner' => 'img/contests/default/imagen.png'
            ));

            foreach (range(1, 10) as $j)
            {
                $winner = new ContestWinner(array(
                    'nombres' => 'PrimerNombre Apellido #' . $j,
                    'rut' => '17.316.XXX-X'
                ));
                $contest->winners()->save($winner);
            }
        }
    }
} 