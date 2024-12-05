<?php
// XML 파일 로드
$xml = simplexml_load_file('Population.xml') or die("Error: Cannot create object");

// 결과를 저장할 배열 초기화
$data = array();

// 각 record 요소 반복
foreach ($xml->data->record as $record) {
    $entry = array();
    // 각 field 요소 반복
    foreach ($record->field as $field) {
        $name = (string)$field['name'];
        // 필요한 필드만 저장
        if ($name == 'Country or Area' || $name == 'Year' || $name == 'Value') {
            $entry[$name] = (string)$field;
        }
    }
    // 데이터가 있으면 배열에 추가
    if (!empty($entry)) {
        $data[] = $entry;
    }
}

// 결과 출력
print_r($data);
