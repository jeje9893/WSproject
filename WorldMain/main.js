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
      { name: "14억1천만", top: "40%", left: "36%", page: "../WorldList/China.html" },
      { name: "14억5천만", top: "44%", left: "27%", page: "../WorldList/India.html" },
      { name: "1억4천만", top: "26%", left: "35%", page: "../WorldList/Russia.html"},
      { name: "2억8천만", top: "54%", left: "36%", page: "../WorldList/Indonesia.html" },
      { name: "8천7백만", top: "32%", left: "19%", page: "../WorldList/Turkey.html" },
      { name: "3천3백만", top: "42%", left: "20%", page: "../WorldList/Saudi_Arabia.html" },

      // 오세아니아 국가
      { name: "2천6백만", top: "66%", left: "42%", page: "../WorldList/Australia.html" },

      // 남아메리카 국가
      { name: "2억1천만", top: "60%", left: "90%", page: "../WorldList/Brazil.html" },

      // 북아메리카 국가
      { name: "3억4천만", top: "34%", left: "74%", page: "../WorldList/USA.html" },
      { name: "3천9백만", top: "26%", left: "70%", page: "../WorldList/Canada.html" },
      { name: "1억3천만", top: "41%", left: "75%", page: "../WorldList/Mexico.html" },

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
