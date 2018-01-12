<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('users')->delete();
        $users = array(
        		['uniqueID'=>uniqid(),'firstname'=>'Kaouther', 'lastname'=>'Mefteh', 'gender'=>'female', 'birthDate'=>'09/29/1992', 'country'=>'Tunisia', 'city'=>'Mahdia', 'email'=>'meftehkaouther@gmail.com', 'mobile'=>'123456789'],
        		['uniqueID'=>uniqid(),'firstname'=>'Tommie', 'lastname'=>'Seese', 'gender'=>'male', 'birthDate'=>'10/04/1990', 'country'=>'France', 'city'=>'Paris', 'email'=>'TommieSeese@gmail.com', 'mobile'=>'123456789'],
        		['uniqueID'=>uniqid(),'firstname'=>'Daine', 'lastname'=>'Voorhies', 'gender'=>'male', 'birthDate'=>'10/21/1978', 'country'=>'New Zealand', 'city'=>'Wellington', 'email'=>'DaineVoorhies@gmail.com', 'mobile'=>'123456789'],
        		['uniqueID'=>uniqid(),'firstname'=>'Lewis', 'lastname'=>'Tawney', 'gender'=>'male', 'birthDate'=>'02/04/1992', 'country'=>'United state', 'city'=>'New York', 'email'=>'LewisTawney@gmail.com', 'mobile'=>'123456789'],
        		['uniqueID'=>uniqid(),'firstname'=>'Ling', 'lastname'=>'Craft', 'gender'=>'male', 'birthDate'=>'02/13/1971', 'country'=>'Russia', 'city'=>'Moscow', 'email'=>'LingCraft@gmail.com', 'mobile'=>'123456789'],
        		['uniqueID'=>uniqid(),'firstname'=>'Stephenie', 'lastname'=>'Noguera', 'gender'=>'female', 'birthDate'=>'12/29/1998', 'country'=>'Canada', 'city'=>'Ottawa', 'email'=>'StephenieNoguera@gmail.com', 'mobile'=>'123456789'],
        		['uniqueID'=>uniqid(),'firstname'=>'Rodrigo', 'lastname'=>'Tulloch', 'gender'=>'male', 'birthDate'=>'01/26/1986', 'country'=>'Australia', 'city'=>'Canberra', 'email'=>'RodrigoTulloch@gmail.com', 'mobile'=>'123456789'] ,
                ['uniqueID'=>uniqid(),'firstname'=>'Rod', 'lastname'=>'Byerley', 'gender'=>'male', 'birthDate'=>'12/21/1973', 'country'=>'France', 'city'=>'Nice', 'email'=>'RodByerley@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Esteban', 'lastname'=>'Upshur', 'gender'=>'male', 'birthDate'=>'09/21/1986', 'country'=>'United state', 'city'=>'Washington', 'email'=>'EstebanUpshur@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Karrie', 'lastname'=>'Alvin', 'gender'=>'female', 'birthDate'=>'06/11/1994', 'country'=>'Japan', 'city'=>'Tokyo', 'email'=>'KarrieAlvin@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Sheena', 'lastname'=>'Rohrbaugh', 'gender'=>'female', 'birthDate'=>'10/01/1988', 'country'=>'China', 'city'=>'Beijing', 'email'=>'SheenaRohrbaugh@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Maragret', 'lastname'=>'Monk', 'gender'=>'female', 'birthDate'=>'04/08/1974', 'country'=>'Brazil', 'city'=>'Brasilia', 'email'=>'MaragretMonk@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Irvin', 'lastname'=>'Owings', 'gender'=>'male', 'birthDate'=>'02/25/1994', 'country'=>'India', 'city'=>'New Delhi', 'email'=>'IrvinOwings@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Glynis', 'lastname'=>'Curatolo', 'gender'=>'female', 'birthDate'=>'09/25/1987', 'country'=>'North Korea', 'city'=>'Pyongyang', 'email'=>'GlynisCuratolo@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Kasha', 'lastname'=>'Debow', 'gender'=>'female', 'birthDate'=>'03/30/1991', 'country'=>'Germany', 'city'=>'Berlin', 'email'=>'KashaDebow@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Lyndia', 'lastname'=>'Althouse', 'gender'=>'female', 'birthDate'=>'10/10/1984', 'country'=>'Spain', 'city'=>'Madrid', 'email'=>'LyndiaAlthouse@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Ken', 'lastname'=>'Ken Fagundes', 'gender'=>'male', 'birthDate'=>'09/11/1986', 'country'=>'Italy', 'city'=>'Rome', 'email'=>'KenFagundes@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Raguel', 'lastname'=>'Eddington', 'gender'=>'male', 'birthDate'=>'08/02/1997', 'country'=>'United Kingdom', 'city'=>'London', 'email'=>'RaguelEddington@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Scott', 'lastname'=>'Scott Troia', 'gender'=>'male', 'birthDate'=>'03/28/1988', 'country'=>'Portugal', 'city'=>'Lisbon', 'email'=>'ScottTroia@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Jarred', 'lastname'=>'Lively', 'gender'=>'male', 'birthDate'=>'11/26/1996', 'country'=>'Spain', 'city'=>'Barcelona', 'email'=>'JarredLively@gmail.com', 'mobile'=>'123456789'],
                ['uniqueID'=>uniqid(),'firstname'=>'Ramona', 'lastname'=>'Davenport', 'gender'=>'female', 'birthDate'=>'12/21/1990', 'country'=>'Germany', 'city'=>'Hamburg', 'email'=>'RamonaDavenport@gmail.com', 'mobile'=>'123456789']       		
        	);
        foreach($users as $user){
        	User::create($user);
        }
        Model::reguard();
    }
}
