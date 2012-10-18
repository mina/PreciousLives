var chartData = (function () {

	"use strict";

	var chartDataArray = [ 
							['dummy']
						];
	
	function updateHeaders(data) {
		console.log("updating headers");
		console.log("The headers were: " + chartDataArray[0]);
		
		var headers = chartDataArray[0];		
		
		headers[0] = 'Date';
		if (headers[headers.length -1] == 'Total visitors') {
			headers.pop();
		}
		
		for (var i = 0; i < data.rows.length; i++) {
			var newheader = data.rows[i][0];
			if (headers.indexOf(newheader) === -1) {
				console.log("adding new header " + newheader);
				headers.push(newheader);
			}	
		}	
		
		headers.push('Total visitors');
		chartDataArray[0] = headers;	
		console.log("the headers are now: " + chartDataArray[0]);
		console.log(chartDataArray);
	}
	
	function addVisitors(data) {
		console.log("adding row of visitors data..");
		
		var date = data['query']['start-date'];
		var visitors = parseInt(data.rows[0][0]);
		
		console.log("the date is " + date + " and the number of visitors is " + visitors);
		
		for (var i = 0; i < chartDataArray.length; i++) {
			if (chartDataArray[i][0] === date) {
				while (chartDataArray[i].length < (chartDataArray[0].length - 1)) {
					chartDataArray[i].push(0);
				}	
				chartDataArray[i].push(visitors);
				break;
			}
		}
		
		console.log("the new data is " + chartDataArray[chartDataArray.length - 1] + " the chartDataArray length is now " + chartDataArray.length );
		console.log(chartDataArray);
		
		var plot = true;
		console.log("checking plot");
		for (var i = 0; i < chartDataArray.length; i++) {
			if (chartDataArray[i].length < 8) {
				plot = false;
				console.log("no plot");
				break
			}
		}
		if (plot) {
			chart.plot(chartDataArray);
		}
	}
	
	function addEvents(data) {
		console.log("adding row of events data..");
				
		console.log("the date is " + data.query['start-date']);
		
		//add events for not found record
		console.log("record not found");
		
		var newdata = new Array();
		newdata.push (data['query']['start-date']);
	
		for (var i = 0; i < data.rows.length; i++) {
			var index = chartDataArray[0].indexOf(data.rows[i][0]);
			console.log("we found index of " + index + " for data " + data.rows[i][0] + " number of hits " + data.rows[i][1])
			newdata[index] = parseInt(data['rows'][i][1]);
		}	
		
		for (var i = 0; i < newdata.length; i++) {
			if (!newdata[i]) {
				newdata[i] = 0;
			}
		}
	
		chartDataArray.push(newdata);
		
		console.log("the new data is " + chartDataArray[chartDataArray.length - 1] + " the chartDataArray length is now " + chartDataArray.length );
		
		console.log(chartDataArray);
	}
	
	function _addData(data) {		
		console.log("data arrived at chartData");
		
		if (data.columnHeaders[0].name == "ga:visitors") {
			console.log("data is visitors");
			addVisitors(data);
		} else {
			console.log("data is events");
			updateHeaders(data);
			addEvents(data);		
		}
	
	}
		
	return {
		addData: function (data) {
			_addData(data);
		}
	}



})();
