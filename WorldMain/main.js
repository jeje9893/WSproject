function showMode(mode){
    const modeWindow = document.getElementById("modeWindow");       // 모드 창
    modeWindow.innerHTML = "";      // 모드 창 초기화

    if(mode === 1){
        const mapImage = document.createElement("img");     // 이미지 생성
        mapImage.src = "WorldMap.jpg";
        mapImage.className = "mapImage";        // 이미지 클래스 설정

        modeWindow.appendChild(mapImage);       // 이미지 추가

        const countries = [
            // 아시아 국가
            {name: "5천백만", top: "36%", left: "41%", page: "South_Korea.html"},
            {name: "1억2천만", top: "36%", left: "45%", page: "Japan.html"},
            {name: "14억1천만", top: "40%", left: "36%", page: "China.html"},
            {name: "14억5천만", top: "44%", left: "27%", page: "India.html"},
            {name: "1억4천만", top: "26%", left: "35%", page: "Russia.html"},
            {name: "2억8천만", top: "54%", left: "36%", page: "Indonesia.html"},
            {name: "8천7백만", top: "32%", left: "19%", page: "Turkey.html"},
            {name: "3천3백만", top: "42%", left: "20%", page: "Saudi_Arabia.html"},

            // 오세아니아 국가
            {name: "2천6백만", top: "66%", left: "42%", page: "Australia.html"},

            // 남아메리카 국가
            {name: "2억1천만", top: "60%", left: "90%", page: "Brazil.html"},

            // 북아메리카 국가
            {name: "3억4천만", top: "34%", left: "74%", page: "USA.html"},
            {name: "3천9백만", top: "26%", left: "70%", page: "Canada.html"},
            {name: "1억3천만", top: "41%", left: "75%", page: "Mexico.html"},

            // 유럽 국가
            {name: "8천4백만", top: "23%", left: "17%", page: "Germany.html"},
            {name: "1천8백만", top: "24%", left: "16%", page: "Netherlands.html"},
            {name: "8백9십만", top: "27%", left: "15%", page: "Switzerland.html"},
            {name: "6천9백만", top: "21%", left: "16%", page: "UK.html"},
            {name: "6천6백만", top: "25%", left: "14%", page: "France.html"},
            {name: "5천9백만", top: "29%", left: "16%", page: "Italy.html"},
            {name: "4천7백만", top: "29%", left: "11%", page: "Spain.html"},
        ];

        countries.forEach(country => {
            const Button = document.createElement("button");    // 버튼 생성
            Button.className = "countryButton";            // 버튼 클래스 설정
            Button.style.top = country.top;            // 버튼 위치 설정
            Button.style.left = country.left;
            Button.textContent = country.name;      // 버튼 텍스트 설정
            Button.onclick = () => {
                location.href = country.page;       // 버튼 클릭 시 페이지 이동
            };
            modeWindow.appendChild(Button);     // 버튼 추가
        });
    }
    if(mode === 2){

    }
    if(mode === 3){

    }
}