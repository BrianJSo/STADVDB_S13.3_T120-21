const pageLimit = 20;
var pageNum = 1;
var strSearch = "";
var mode = "";
var maxPage = 100;

$(document).ready(function () {
  mode = $("#searchMode").val();
  $("#pageNum").text(pageNum);
  search();

  $("#searchBtn").on("click", function () {
    pageNum = 1;
    mode = $("#searchMode").val();
    strSearch = $("#searchQuery").val();
    search();
  });

  $("#prevBtn").on("click", function () {
    if (pageNum > 1) {
      pageNum--;
      search();
    }
  });

  $("#nextBtn").on("click", function () {
    if (pageNum < maxPage) {
      pageNum++;
      search();
    }
  });
});

function search() {
  $("#results").empty();
  $("#results").attr("start", pageLimit * (pageNum - 1) + 1);
  $("#pageNum").text(pageNum);

  $.get(
    "search.php",
    { mode: mode, strSearch: strSearch, pageNum: pageNum },
    function (data) {
      $("#results").append(data);
    }
  );
}
