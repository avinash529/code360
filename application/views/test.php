print first name when = 1,2,5,6,9,10
print last name when = 3,4,7,8,11,12


$a = range(1,100);

foreach($a as $v){
    if(in_array($v%12,[ 1,2,5,6,9,10])){
        echo "First Name\n";
        
    }
    else if(in_array($v%12,[3,4,7,8,11,12])){
        echo "Last Name\n";
    }
}

