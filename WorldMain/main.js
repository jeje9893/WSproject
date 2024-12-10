function showMode(mode) {
  const modeWindow = document.getElementById("modeWindow"); // 모드 창
  modeWindow.innerHTML = ""; // 모드 창 초기화

  if (mode === 1) {
    const mapImage = document.createElement("img"); // 이미지 생성
    mapImage.src = "../img/WorldMap.jpg";
    mapImage.className = "mapImage"; // 이미지 클래스 설정

    modeWindow.appendChild(mapImage); // 이미지 추가

    const countries = [
      // 아시아 국가
      { name: "5천백만", top: "36%", left: "41%", page: "../WorldList/South_Korea.html" },
      { name: "1억2천만", top: "36%", left: "45%", page: "../WorldList/Japan.html" },
      { name: "14억1천만", top: "40%", left: "34%", page: "../WorldList/China.html" },
      { name: "14억5천만", top: "44%", left: "27%", page: "../WorldList/India.html" },
      { name: "1억4천만", top: "26%", left: "35%", page: "../WorldList/Russia.html"},
      { name: "2억8천만", top: "54%", left: "36%", page: "../WorldList/Indonesia.html" },
      { name: "8천7백만", top: "32%", left: "19%", page: "../WorldList/Turkey.html" },
      { name: "3천3백만", top: "42%", left: "20%", page: "../WorldList/Saudi_Arabia.html" },

      // 오세아니아 국가
      { name: "2천6백만", top: "66%", left: "42%", page: "../WorldList/Australia.html" },

      // 남아메리카 국가
      { name: "2억1천만", top: "60%", left: "88%", page: "../WorldList/Brazil.html" },

      // 북아메리카 국가
      { name: "3억4천만", top: "34%", left: "74%", page: "../WorldList/USA.html" },
      { name: "3천9백만", top: "26%", left: "70%", page: "../WorldList/Canada.html" },
      { name: "1억3천만", top: "41%", left: "74%", page: "../WorldList/Mexico.html" },

      // 유럽 국가
      { name: "8천4백만", top: "23%", left: "17%", page: "../WorldList/Germany.html" },
      { name: "1천8백만", top: "24%", left: "16%", page: "../WorldList/Netherlands.html" },
      { name: "8백9십만", top: "27%", left: "15%", page: "../WorldList/Switzerland.html" },
      { name: "6천9백만", top: "21%", left: "16%", page: "../WorldList/UK.html" },
      { name: "6천6백만", top: "25%", left: "14%", page: "../WorldList/France.html" },
      { name: "5천9백만", top: "29%", left: "16%", page: "../WorldList/Italy.html" },
      { name: "4천7백만", top: "29%", left: "11%", page: "../WorldList/Spain.html" },
    ];

    countries.forEach((country) => {
      const Button = document.createElement("button"); // 버튼 생성
      Button.className = "countryButton"; // 버튼 클래스 설정
      Button.style.top = country.top; // 버튼 위치 설정
      Button.style.left = country.left;
      Button.textContent = country.name; // 버튼 텍스트 설정
      Button.onclick = () => {
        location.href = country.page; // 버튼 클릭 시 페이지 이동
      };
      modeWindow.appendChild(Button); // 버튼 추가
    });
  }
  if (mode === 2) {
    const flags = [
      { name: "South Korea", population: 51271480, flag: "../img/South_Korea.png", page: "../WorldList/South_Korea.html" },
      { name: "Japan", population: 122631432, flag: "../img/Japan.png", page: "../WorldList/Japan.html" },
      { name: "China", population: 1425176357, flag: "../img/China.png", page: "../WorldList/China.html" },
      { name: "India", population: 1441719852, flag: "../img/India.png", page: "../WorldList/India.html" },
      { name: "Russia", population: 144820423, flag: "../img/Russia.png", page: "../WorldList/Russia.html" },
      { name: "Indonesia", population: 279798049, flag: "../img/Indonesia.png", page: "../WorldList/Indonesia.html" },
      { name: "Turkey", population: 86260417, flag: "../img/Turkey.png", page: "../WorldList/Turkey.html" },
      { name: "Saudi Arabia", population: 37473929, flag: "../img/Saudi_Arabia.png", page: "../WorldList/Saudi_Arabia.html" },
      { name: "Australia", population: 26699482, flag: "../img/Australia.png", page: "../WorldList/Australia.html" },
      { name: "Brazil", population: 217637297, flag: "../img/Brazil.png", page: "../WorldList/Brazil.html" },
      { name: "USA", population: 341814420, flag: "../img/USA.png", page: "../WorldList/USA.html" },
      { name: "Canada", population: 39107046, flag: "../img/Canada.png", page: "../WorldList/Canada.html" },
      { name: "Mexico", population: 129388467, flag: "../img/Mexico.png", page: "../WorldList/Mexico.html" },
      { name: "Germany", population: 83252474, flag: "../img/Germany.png", page: "../WorldList/Germany.html" },
      { name: "Netherlands", population: 17671125, flag: "../img/Netherlands.png", page: "../WorldList/Netherlands.html" },
      { name: "Switzerland", population: 8900000, flag: "../img/Switzerland.png", page: "../WorldList/Switzerland.html" },
      { name: "UK", population: 67961439, flag: "../img/UK.png", page: "../WorldList/UK.html" },
      { name: "France", population: 67400000, flag: "../img/France.png", page: "../WorldList/France.html" },
      { name: "Italy", population: 58697744, flag: "../img/Italy.png", page: "../WorldList/Italy.html" },
      { name: "Spain", population: 48692804, flag: "../img/Spain.png", page: "../WorldList/Spain.html" },
    ];

    // 인구수로 내림차순 정렬
    flags.sort((a, b) => b.population - a.population);

    const centerX = 450; // .window의 가로 크기 절반
    const centerY = 300; // .window의 세로 크기 절반
    let currentAngle = 0;
    let currentRadius = 0;

    flags.forEach((country, index) => {
      const size = Math.sqrt(country.population) / 200 +30; // 인구수에 따른 크기 계산
      const flagRadius = size / 3;

      let x, y;

      if (index === 0) {
        // 가장 큰 동그라미를 중앙에 배치
        x = centerX - flagRadius;
        y = centerY - flagRadius;
        currentRadius = flagRadius;
      }
      // else if (index === 1) {
      //   // 두 번째 원을 첫 번째 원의 오른쪽에 배치
      //   x = centerX + currentRadius + flagRadius;
      //   y = centerY - flagRadius;
      // }
      else {
        if (index === 1) {
          // 세 번째 원에서만 currentRadius 증가
          currentRadius += flagRadius + 10;
          currentAngle -= (2 * Math.PI) / (flags.length - 2) + flagRadius / 50
        }
        // 각도를 일정하게 증가시켜 원형으로 배치
        currentRadius += 10 - flagRadius * 0.15;
        currentAngle += (2 * Math.PI) / (flags.length - 2) + flagRadius / 50;
        x = centerX + currentRadius * Math.cos(currentAngle) - flagRadius ;
        y = centerY + currentRadius * Math.sin(currentAngle) - flagRadius ;
      }

      const img = document.createElement("img");
      img.src = country.flag;
      img.alt = country.name;
      img.className = "flagImage";
      img.style.width = `${size}px`;
      img.style.height = `${size}px`;
      img.style.left = `${x}px`;
      img.style.top = `${y}px`;
      img.onclick = () => {
        location.href = country.page;
      };
      modeWindow.appendChild(img);
    });
  }
  if (mode === 3) {
    google.charts.load("current", { packages: ["corechart", "bar"] });
    google.charts.setOnLoadCallback(function () {
      var data = google.visualization.arrayToDataTable([
        ["국가", "인구수"],
        ["미국", 341814420],
        ["중국", 1425176357],
        ["일본", 122631432],
        ["독일", 83252474],
        ["인도", 1441719852],
        ["영국", 67961439],
        ["프랑스", 67400000],
        ["이탈리아", 58697744],
        ["브라질", 217637297],
        ["캐나다", 39107046],
        ["호주", 26699482],
        ["러시아", 144820423],
        ["멕시코", 129388467],
        ["대한민국", 51271480],
        ["인도네시아", 279798049],
        ["사우디 아라비아", 37473929],
        ["스페인", 48692804],
        ["네덜란드", 17671125],
        ["튀르키예", 86260417],
      ]);

      data.sort([{ column: 1, desc: false }]); // 내림차순 정렬

      var options = {
        title: "GDP 상위 20개국 국가별 인구수",
        chartArea: { width: "70%" },
        hAxis: {
          minValue: 0,
        },
        bars: "horizontal", //가로막대 그래프 설정
      };
      var chart = new google.visualization.BarChart(
        document.getElementById("modeWindow")
      );
      chart.draw(data, options);
    });
  }
}
