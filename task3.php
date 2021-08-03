<?php
class getDataFromCSV
{
    public function getData()
    {
        $data = array_map('str_getcsv', file('MOCK_DATA_TEST_TI.csv'));
        return $data;
    }
}
class editDataFormat extends getDataFromCSV
{
    public function formatData()
    {
        $file = fopen('data.csv','w+');
        $data =$this->getData();
        foreach ($data as $key => $item) {
            if ($key == 0) continue;
            $pattern = '/([0-9]{4})-([0-9]{2})-([0-9]{2})/';
            $replacement = '$3.$2.$1';
            $newData = preg_replace($pattern, $replacement, $item[8]);
            $item[8] = $newData;
            fputcsv($file,$item);

        }
        fclose($file);
        return $data;
    }
}
class editPhoneNumber extends getDataFromCSV
{
    public function formatPhone()
    {
        $file = fopen('data.csv','w+');

        $data =$this->getData();
        foreach ($data as $key => $item) {
            if ($key == 0) continue;
           $newData1 = preg_replace('`\D`', '', "$item[6]");
           $item[6] = $newData1;
            fputcsv($file,$item);
        }
        fclose($file);

     /*  echo '<pre>';
        print_r($data);
        echo '</pre>';*/
       return $data;
    }
}






