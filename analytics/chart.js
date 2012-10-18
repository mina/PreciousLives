var chart = (function() {
	"use strict";
	
	google.load('visualization', '1.0', {
		'packages': ['corechart']
	});
	
	
	function fillZerosInData(data) {
		console.log("filling zeros in the plot data");
		var width = data[0].length;
		console.log("the width is: " + width);
		for (var i = 1; i < data.length; i++) {
			for (var j = 0; j < data[i].length; j++) {
				console.log(data[i]);
				if (!data[i][j]) {
					data[i][j] = 0;
				}
			}
			while (data[i].length < width) {
				data[i].push(0);
			}
			console.log("the new row is " + data[i]);
		}
	}
	
	function sortMultiDimensional(a,b) {
    	// this sorts the array using the second element    
    	return ((a[0] < b[0]) ? -1 : ((a[0] > b[0]) ? 1 : 0));
    }
	
	function drawChart(dataArray) {
		//fillZerosInData(dataArray);
		var headers = dataArray.shift();
		dataArray.sort(sortMultiDimensional);
		dataArray.unshift(headers);
		console.log("creating chart from data:");
		
		console.log(dataArray);
				var data = new google.visualization.arrayToDataTable(dataArray);
		
		// Set chart options
		var options = {
			'title': 'Penyo.com',
			'width': 1600,
			'height': 1000,
			'is3D': true
		};
		// Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		chart.draw(data, options);
	}
	
	//public members
	return {
		plot: function (data) {
			drawChart(data);
		}
	}
})();