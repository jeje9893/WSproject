function showMode(mode) {
  const modeWindow = document.getElementById("modeWindow"); // 모드 창
  modeWindow.innerHTML = ""; // 모드 창 초기화

  if (mode === 1) {
    const mapImage = document.createElement("img"); // 이미지 생성
    mapImage.src = "../img/WorldMap.jpg";
    mapImage.className = "mapImage"; // 이미지 클래스 설정

    modeWindow.appendChild(mapImage); // 이미지 추가

    const countryLayout = { //버튼 위치 및 페이지 설정
      "South Korea": { top: "36%", left: "41%", page: "../WorldList/South_Korea.php" },
      "Japan": { top: "36%", left: "45%", page: "../WorldList/Japan.php" },
      "China": { top: "40%", left: "34%", page: "../WorldList/China.php" },
      "India": { top: "44%", left: "27%", page: "../WorldList/India.php" },
      "Russia": { top: "26%", left: "35%", page: "../WorldList/Russia.php" },
      "Indonesia": { top: "54%", left: "36%", page: "../WorldList/Indonesia.php" },
      "Turkey": { top: "32%", left: "19%", page: "../WorldList/Turkey.php" },
      "Saudi Arabia": { top: "42%", left: "20%", page: "../WorldList/Saudi_Arabia.php" },
      "Australia": { top: "66%", left: "42%", page: "../WorldList/Australia.php" },
      "Brazil": { top: "60%", left: "88%", page: "../WorldList/Brazil.php" },
      "USA": { top: "34%", left: "74%", page: "../WorldList/USA.php" },
      "Canada": { top: "26%", left: "70%", page: "../WorldList/Canada.php" },
      "Mexico": { top: "41%", left: "74%", page: "../WorldList/Mexico.php" },
      "Germany": { top: "23%", left: "17%", page: "../WorldList/Germany.php" },
      "Netherlands": { top: "24%", left: "16%", page: "../WorldList/Netherlands.php" },
      "Switzerland": { top: "27%", left: "15%", page: "../WorldList/Switzerland.php" },
      "UK": { top: "21%", left: "16%", page: "../WorldList/UK.php" },
      "France": { top: "25%", left: "14%", page: "../WorldList/France.php" },
      "Italy": { top: "29%", left: "16%", page: "../WorldList/Italy.php" },
      "Spain": { top: "29%", left: "11%", page: "../WorldList/Spain.php" },
    };

    fetch('get_population.php?mode=1')
      .then(response => response.json())
      .then(data => { // 국가별 인구수 데이터를 가져옵니다.
        data.forEach(item => {
          const layout = countryLayout[item.name];
          if (layout) {
            const button = document.createElement("button"); // 버튼 생성
            button.className = "countryButton"; // 버튼 클래스 설정
            button.style.top = layout.top; // 버튼 위치 설정
            button.style.left = layout.left;
            button.textContent = `${Math.floor(item.population / 10000)}만명`; // 인구수를 10,000으로 나누고 나머지를 제거
            button.onclick = () => {
              location.href = layout.page; // 버튼 클릭 시 페이지 이동
            };
            modeWindow.appendChild(button); // 버튼 추가
          }
        });
      })
      .catch(error => {
        console.error('Error fetching mode1 data:', error);
      });
  }

  if (mode === 2) {
    // countries 데이터를 데이터베이스에서 가져옵니다.
    fetch('get_population.php?mode=2')
      .then(response => response.json())
      .then(data => {
        const countries = data.map(country => ({
          name: country.name,
          population: country.population,
          flag: `../img/${country.name.replace(/ /g, '_')}.png`,
          page: `../WorldList/${country.name.replace(/ /g, '_')}.php`
        }));

        // 인구수에 따른 내림차순 정렬
        countries.sort((a, b) => b.population - a.population);

        const centerX = 450; // .window의 가로 크기 절반
        const centerY = 300; // .window의 세로 크기 절반
        let currentAngle = 0;
        let currentRadius = 0;

        countries.forEach((country, index) => {
          const size = Math.sqrt(country.population) / 400 + 50; // 인구수에 따른 크기 계산
          const flagRadius = size / 2;

          let x, y;

          if (index === 0) {
            // 가장 큰 이미지를 중앙에 배치
            x = centerX - flagRadius;
            y = centerY - flagRadius;
            currentRadius = flagRadius;
          } else {
            // 각도를 일정하게 증가시켜 원형으로 배치
            currentRadius += 10 - flagRadius * 0.02;
            currentAngle += (2 * Math.PI) / (countries.length - 1) + flagRadius / 50;
            x = centerX + currentRadius * Math.cos(currentAngle) - flagRadius;
            y = centerY + currentRadius * Math.sin(currentAngle) - flagRadius;
          }

          const img = document.createElement("img"); // 이미지 생성
          img.src = country.flag;
          img.alt = country.name;
          img.className = "flagImage"; // 원형 스타일을 위한 클래스
          img.style.width = `${size}px`;
          img.style.height = `${size}px`;
          img.style.left = `${x}px`;
          img.style.top = `${y}px`;
          img.style.position = "absolute"; // 절대 위치 지정
          img.onclick = () => {
            location.href = country.page; // 이미지 클릭 시 페이지 이동
          };
          modeWindow.appendChild(img); // 이미지 추가
        });
      })
      .catch(error => {
        console.error('Error fetching countries:', error);
      });
  }

  if (mode === 3) {
    fetch('get_population.php?mode=3')
      .then(response => response.json())
      .then(data => {
        google.charts.load("current", { packages: ["corechart", "bar"] });
        google.charts.setOnLoadCallback(function () {
          // 데이터에 헤더 행 추가
          const formattedData = [
            ["국가", "인구수"],
            ...data.map(item => [item.name, item.population])
          ];

          var chartData = google.visualization.arrayToDataTable(formattedData);

          var options = {
            title: "GDP 상위 20개국 국가별 인구수",
            chartArea: { width: "70%" },
            hAxis: {
              minValue: 0,
            },
            bars: "horizontal", // 가로막대 그래프 설정
          };
          var chart = new google.visualization.BarChart(
            document.getElementById("modeWindow")
          );
          chart.draw(chartData, options);
        });
      })
      .catch(error => {
        console.error('Error fetching mode3 data:', error);
      });
  }
}
